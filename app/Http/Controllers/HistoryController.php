<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Midtrans\Config;
use Midtrans\Snap;

class HistoryController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $orders->getCollection()->transform(function ($order) {
            $order->status_badge = $this->getStatusBadge($order->status);
            return $order;
        });

        return view('history.index', compact('orders'));
    }

    public function getSnapToken(Order $order)
{
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    if ($order->status !== 'pending') {
        return redirect()->back()->with('error', 'Order is not pending payment');
    }

    $params = [
        'transaction_details' => [
            'order_id' => $order->id,
            'gross_amount' => $order->final_price,
        ],
        'customer_details' => [
            'first_name' => $order->customer_name,
            'email' => $order->customer_email,
            'phone' => $order->hp,
            'address' => $order->alamat,
            'postal_code' => $order->pos,
        ],
    ];

    try {
        $snapToken = Snap::getSnapToken($params);
        return response()->json(['snap_token' => $snapToken]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->status_badge = $this->getStatusBadge($order->status);
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        // Add public URL for foto_resi
        $order->foto_resi_url = $order->foto_resi
            ? asset('storage/' . $order->foto_resi)
            : null;

        return view('history.show', compact('order', 'orderItems'));
    }

    public function edit(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($order->status, ['processing', 'shipped'])) {
            return redirect()->route('history.show', $order->id)
                ->with('error', 'Pesanan tidak dapat diedit pada status ini');
        }

        $order->status_badge = $this->getStatusBadge($order->status);
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        // Add foto_resi URL and debug info
        $order->foto_resi_url = $order->foto_resi
            ? asset('storage/' . $order->foto_resi)
            : null;

        return view('history.edit', compact('order', 'orderItems'));
    }

    public function update(Order $order, Request $request)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'tracking_number' => 'required|string|max:50',
            'receipt_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_resi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle foto_resi upload
        if ($request->hasFile('foto_resi')) {
            // Delete old file if exists
            if ($order->foto_resi) {
                Storage::disk('public')->delete($order->foto_resi);
            }

            // Store new file in storage/foto_resi directory
            $path = $request->file('foto_resi')->store('foto_resi', 'public');
            $validated['foto_resi'] = $path;
        }

        // Handle receipt_photo (separate directory)
        if ($request->hasFile('receipt_photo')) {
            if ($order->receipt_photo) {
                Storage::delete('public/receipts/' . $order->receipt_photo);
            }

            $filename = 'receipt_' . $order->id . '_' . time() . '.' . $request->file('receipt_photo')->getClientOriginalExtension();
            $path = $request->file('receipt_photo')->storeAs('public/receipts', $filename);
            $validated['receipt_photo'] = $filename;

            if ($order->status === 'processing') {
                $validated['status'] = 'shipped';
            }
        }

        $order->update($validated);

        return redirect()->route('history.edit', $order->id)
            ->with('success', 'Data pesanan berhasil diperbarui');
    }

    public function invoice(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $orderItems = OrderItem::where('order_id', $order->id)->get();
        return view('history.invoice', compact('order', 'orderItems'));
    }

    public function invoicePdf(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $orderItems = OrderItem::where('order_id', $order->id)->get();

        $invoiceData = [
            'invoice_number' => 'INV-' . $order->id . '-' . now()->format('Ymd'),
            'invoice_date' => $order->created_at->format('d F Y'),
            'due_date' => $order->created_at->addDays(7)->format('d F Y'),
            'order' => $order,
            'orderItems' => $orderItems,
            'customer' => [
                'name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->hp,
                'address' => $order->alamat,
                'postal_code' => $order->pos,
                'city' => $order->destination_city,
            ],
            'company' => [
                'name' => config('app.name'),
                'address' => 'Jl. Contoh No. 123, Kota Contoh',
                'phone' => '+62 123 4567 890',
                'email' => 'info@example.com',
            ]
        ];

        $pdf = Pdf::loadView('history.invoice-pdf', $invoiceData);
        return $pdf->stream("invoice-{$invoiceData['invoice_number']}.pdf");
    }

    private function getStatusBadge($status)
    {
        $badges = [
            'pending' => '<span class="badge bg-warning text-dark">Menunggu Pembayaran</span>',
            'processing' => '<span class="badge bg-info text-white">Diproses</span>',
            'shipped' => '<span class="badge bg-primary text-white">Dikirim</span>',
            'completed' => '<span class="badge bg-success text-white">Selesai</span>',
            'cancelled' => '<span class="badge bg-danger text-white">Dibatalkan</span>',
        ];

        return $badges[$status] ?? '<span class="badge bg-secondary text-white">' . ucfirst($status) . '</span>';
    }
}
