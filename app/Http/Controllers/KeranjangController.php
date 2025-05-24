<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Http;

class KeranjangController extends Controller
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->middleware('auth:customer', ['except' => ['count']]);
        $this->apiKey = env('RAJAONGKIR_API_KEY');
        $this->baseUrl = env('RAJAONGKIR_BASE_URL');
    }

    public function index()
    {
        try {
            $cartItems = Cart::getContent();
            $isEmpty = Cart::isEmpty();
            //hitung total berat dalam gram
            $totalWeight = $cartItems->sum(function($item) {
                return ($item->attributes['berat'] ?? 0) * $item->quantity * 1000;
            });

            $validated = session('shipping_validated', []);

            $provincesResponse = Http::withHeaders([
                'key' => $this->apiKey
            ])->get("{$this->baseUrl}/province");
            //ambil semua  response provinsi
            $provinces = [];
            if ($provincesResponse->successful()) {
                $provinces = $provincesResponse->json()['rajaongkir']['results'];
            }

            $citiesResponse = Http::withHeaders([
                'key' => $this->apiKey
            ])->get("{$this->baseUrl}/city");

            $cities = [];
            if ($citiesResponse->successful()) {
                $cities = $citiesResponse->json()['rajaongkir']['results'];
            }

            $couriers = [
                'jne' => 'JNE',
                'pos' => 'POS Indonesia',
                'tiki' => 'TIKI'
            ];

            return view('keranjang.index', [
                'cartItems' => $cartItems,
                'isEmpty' => $isEmpty,
                'total' => Cart::getTotal(),
                'subTotal' => Cart::getSubTotal(),
                'totalQuantity' => Cart::getTotalQuantity(),
                'totalWeight' => $totalWeight,
                'provinces' => $provinces,
                'couriers' => $couriers,
                'cities' => $cities,
                'shippingCost' => session('shipping_cost', 0),
                'shippingResult' => session('shipping_result'),
                'validated' => $validated
            ]);
        } catch (\Exception $e) {
            return view('keranjang.index', [
                'cartItems' => collect(),
                'isEmpty' => true,
                'total' => 0,
                'subTotal' => 0,
                'totalQuantity' => 0,
                'totalWeight' => 0,
                'provinces' => [],
                'couriers' => [],
                'cities' => [],
                'shippingCost' => 0,
                'shippingResult' => null,
                'validated' => []
            ])->with('error', 'Terjadi kesalahan saat memuat keranjang belanja.');
        }
    }

    public function calculateShipping(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required|numeric',
            'destination_province' => 'required|numeric',
            'destination' => 'required|numeric',
            'weight' => 'required|numeric|min:1',
            'courier' => 'required|in:jne,pos,tiki'
        ]);

        $response = Http::withHeaders([
            'key' => $this->apiKey,
            'content-type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post("{$this->baseUrl}/cost", [
            'origin' => $validated['origin'],
            'destination' => $validated['destination'],
            'weight' => $validated['weight'],
            'courier' => $validated['courier']
        ]);

        if ($response->successful()) {
            $result = $response->json()['rajaongkir'];
            $shippingCost = 0;

            if (!empty($result['results'][0]['costs'])) {
                $cheapest = collect($result['results'][0]['costs'])->sortBy('cost.0.value')->first();
                $shippingCost = $cheapest['cost'][0]['value'] ?? 0;
            }

            session([
                'shipping_result' => $result,
                'shipping_cost' => $shippingCost,
                'shipping_validated' => $validated
            ]);

            return response()->json([
                'success' => true,
                'result' => $result
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghitung ongkos kirim. Silakan coba lagi.'
        ], 400);
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/city", [
            'province' => $provinceId
        ]);

        return $response->successful()
            ? response()->json($response->json()['rajaongkir']['results'])
            : response()->json([]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $produk = Produk::findOrFail($validated['produk_id']);

        if ($produk->stok < $validated['quantity']) {
            return back()->with('error', 'Stok tidak mencukupi! Stok tersedia: '.$produk->stok);
        }

        $existingItem = Cart::get($produk->id);
        $newQuantity = $existingItem ? $existingItem->quantity + $validated['quantity'] : $validated['quantity'];

        if ($produk->stok < $newQuantity) {
            return back()->with('error', 'Stok tidak mencukupi untuk jumlah yang diminta! Stok tersedia: '.$produk->stok);
        }

        Cart::add([
            'id' => $produk->id,
            'name' => $produk->nama_produk,
            'price' => $produk->harga,
            'quantity' => $validated['quantity'],
            'attributes' => [
                'berat' => $produk->berat,
                'foto' => $produk->foto,
                'stok' => $produk->stok,
                'kategori' => $produk->kategori->nama_kategori ?? 'Tidak ada kategori'
            ],
            'associatedModel' => $produk
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item = Cart::get($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item tidak ditemukan dalam keranjang'
            ], 404);
        }

        if ($item->attributes['stok'] < $validated['quantity']) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi! Stok tersedia: '.$item->attributes['stok']
            ], 400);
        }

        Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $validated['quantity']
            ]
        ]);

        $updatedItem = Cart::get($id);
        $totalWeight = Cart::getContent()->sum(function($item) {
            return ($item->attributes['berat'] ?? 0) * $item->quantity * 1000;
        });

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diperbarui',
            'quantity' => $validated['quantity'],
            'item_price' => $updatedItem->price,
            'subTotal' => Cart::getSubTotal(),
            'totalWeight' => $totalWeight
        ]);
    }

    public function remove(Request $request, $id)
    {
        if (!Cart::get($id)) {
            return back()->with('error', 'Item tidak ditemukan dalam keranjang');
        }

        Cart::remove($id);
        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function clear()
    {
        Cart::clear();
        session()->forget(['shipping_result', 'shipping_cost', 'shipping_validated']);
        return redirect()->route('keranjang.index')->with('success', 'Keranjang berhasil dikosongkan');
    }

    public function count()
    {
        return response()->json([
            'count' => Cart::getTotalQuantity()
        ]);
    }
}
