<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\OngkirProController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MidtransController;


Route::get('/', function () {
    return redirect()->route('beranda');
});

// ================= FRONTEND ROUTES =================
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// Produk Frontend
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::post('/produk/detail/{id}', [ProdukController::class, 'detail']);
Route::get('/produk/kategori/{id}', [ProdukController::class, 'produkKategori'])->name('produk.kategori');
Route::get('/produk/all', [ProdukController::class, 'produkAll'])->name('produk.all');

// Product Search - Added missing route
Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');

// Tentang Kami
Route::get('/tentang-kami', [TentangKamiController::class, 'TentangKami'])->name('tentang-kami');

// Kontak
Route::get('/kontak', [KontakController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store'); // Added missing POST route

// Keranjang
Route::prefix('keranjang')->group(function () {
    Route::get('/', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/add', [KeranjangController::class, 'add'])->name('keranjang.add');
    Route::put('/update/{id}', [KeranjangController::class, 'update'])->name('keranjang.update'); // Tambah parameter {id}
    Route::delete('/remove/{id}', [KeranjangController::class, 'remove'])->name('keranjang.remove'); // Juga untuk remove
    Route::post('/clear', [KeranjangController::class, 'clear'])->name('keranjang.clear');
    Route::get('/count', [KeranjangController::class, 'count'])->name('keranjang.count');
});

// ================= BACKEND ROUTES (Admin) =================
Route::prefix('backend')->name('backend.')->group(function () {

    // Auth (tanpa middleware)
    Route::get('login', [LoginController::class, 'loginBackend'])->name('login');
    Route::post('login', [LoginController::class, 'authenticateBackend'])->name('login.authenticate');
    Route::post('logout', [LoginController::class, 'logoutBackend'])->name('logout');

Route::get('/backend/beranda', [BerandaController::class, 'berandaBackend'])
    ->name('backend.beranda')
    ->middleware(['web', 'auth:user']);

    // Hanya untuk admin yang sudah login pakai guard:user
    Route::middleware('auth:user')->group(function () {
        Route::get('beranda', [BerandaController::class, 'berandaBackend'])->name('beranda');

        Route::resource('user', UserController::class);
        Route::get('/user/{customer}/edit', [UserController::class, 'editCustomer'])->name('backend.user.editCustomer');
        Route::delete('/backend/user/{id}', [UserController::class, 'destroy'])->name('backend.user.destroy');

        Route::resource('kategori', KategoriController::class);
        Route::resource('produk', ProdukController::class);
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

        // Foto Produk
        Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('foto_produk.store');
        Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('foto_produk.destroy');

        // Laporan
        Route::get('laporan/formuser', [UserController::class, 'formUser'])->name('laporan.formuser');
        Route::post('laporan/cetakuser', [UserController::class, 'cetakUser'])->name('laporan.cetakuser');

        Route::get('laporan/formproduk', [ProdukController::class, 'formProduk'])->name('laporan.formproduk');
        Route::post('laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('laporan.cetakproduk');

        // Added missing order management routes for admin
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'adminIndex'])->name('backend.orders.index');
            Route::get('/{id}', [OrderController::class, 'adminShow'])->name('backend.orders.show');
            Route::put('/{id}/status', [OrderController::class, 'updateStatus'])->name('backend.orders.update-status');
        });
    });
});

// ================= CUSTOMER ROUTES =================
// Login Customer
Route::get('customer/login', [CustomerController::class, 'showLoginForm'])->name('customer.login');
Route::post('customer/login', [CustomerController::class, 'login']);
Route::post('customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');

// Registration - Added missing routes
Route::get('customer/register', [CustomerController::class, 'showRegistrationForm'])->name('customer.register');
Route::post('customer/register', [CustomerController::class, 'register']);

// Google OAuth untuk Customer
Route::get('auth/google', [CustomerController::class, 'redirect'])->name('auth.google');
Route::get('auth/google/callback', [CustomerController::class, 'callback'])->name('auth.google.callback');

// Account Management (Customer), pakai default auth:web
Route::middleware('auth')->group(function () {
    Route::get('/account', [CustomerController::class, 'edit'])->name('account.edit');
    Route::post('/account/update', [CustomerController::class, 'update'])->name('account.update');
    Route::get('/account/delete-foto', [CustomerController::class, 'deleteFoto'])->name('account.delete-foto');
    Route::get('/account/change-password', [CustomerController::class, 'showChangePasswordForm'])->name('account.change-password'); // Added
    Route::post('/account/change-password', [CustomerController::class, 'changePassword']); // Added

    // Ini sebenarnya logout sudah ada di atas, bisa hapus yang ini kalau mau
    Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
});

// ============================== RAJA ONGKIR=================================///
// Grup route untuk RajaOngkir API
Route::get('/ongkir', [OngkirController::class, 'index'])->name('ongkir.index');
Route::post('/ongkir/calculate', [OngkirController::class, 'calculate'])->name('ongkir.calculate');
Route::get('/ongkir/cities/{provinceId}', [OngkirController::class, 'getCities'])->name('ongkir.cities');
Route::post('/keranjang/ongkir', [KeranjangController::class, 'calculateOngkir'])->name('keranjang.calculateOngkir');
Route::post('/ongkir/apply-cost', [OngkirController::class, 'applyCost'])->name('ongkir.apply-cost');
Route::post('/ongkir/clear', [OngkirController::class, 'clearShipping'])->name('ongkir.clear');

// ============================== END RAJA ONGKIR=================================///

// ============================== HISTORY =============================///
Route::prefix('history')->middleware(['auth'])->group(function () {
    Route::get('/', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/{order}', [HistoryController::class, 'show'])->name('history.show');
    Route::get('/{order}/edit', [HistoryController::class, 'edit'])->name('history.edit');
    Route::put('/{order}', [HistoryController::class, 'update'])->name('history.update');
    Route::get('/{order}/invoice', [HistoryController::class, 'invoice'])->name('history.invoice');
    Route::get('/{order}/invoice-pdf', [HistoryController::class, 'invoicePdf'])->name('history.invoice.pdf');
});

// Rute untuk checkout dan order
Route::middleware(['auth'])->group(function () {
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});


// History Routes
Route::get('/invoice/{invoiceId}', [InvoiceController::class, 'showInvoice'])->name('invoice.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('history.show');
    Route::put('/history/{id}', [HistoryController::class, 'update'])->name('history.update');
    Route::get('/history/{id}/invoice', [HistoryController::class, 'invoice'])->name('history.invoice');
    Route::get('/history/{id}/invoice/download', [HistoryController::class, 'downloadInvoice'])->name('history.invoice.download');
});


// Review Routes - Added new group
Route::middleware(['auth'])->prefix('reviews')->group(function () {
    Route::post('/{product_id}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});


// Add this route
Route::get('/history/{order}/snap-token', [HistoryController::class, 'getSnapToken'])
    ->name('history.snap-token')
    ->middleware('auth');

