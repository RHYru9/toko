<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Kategori; // Changed from Category to Kategori
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        // Get user data
        $user = Auth::guard('user')->user();

        // Basic statistics
        $totalProducts = Produk::count();
        $totalCategories = Kategori::count(); // Changed to Kategori
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();

        // Order status statistics
        $orderStatusData = [
            Order::where('status', 'pending')->count(),
            Order::where('status', 'completed')->count(),
        ];
        $orderStatusLabels = ['Pending', 'Completed'];

        // Products by category
        $categories = Kategori::withCount('produk')->get(); // Using Kategori model
        $categoryLabels = $categories->pluck('nama_kategori'); // Changed to nama_kategori
        $categoryData = $categories->pluck('produk_count');

        // Recent orders
        $recentOrders = Order::latest()->take(5)->get();

        return view('backend.v_beranda.index', [
            'judul' => 'Beranda',
            'sub' => 'Halaman Beranda',
            'user' => $user,
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'orderStatusData' => $orderStatusData,
            'orderStatusLabels' => $orderStatusLabels,
            'categoryLabels' => $categoryLabels,
            'categoryData' => $categoryData,
            'recentOrders' => $recentOrders,
        ]);
    }

    public function index()
    {
        $produk = Produk::where('status', 1)->orderBy('updated_at', 'desc')->paginate(6);
        return view('v_beranda.index', [
            'judul' => 'Halaman Beranda',
            'produk' => $produk,
        ]);
    }
}
