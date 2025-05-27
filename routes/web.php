<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderHistoryController;

// Public Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/payment/{order_id}/{total}', [PesananController::class, 'payment'])->name('payment');
Route::post('/payment/process', [PesananController::class, 'processPayment'])->name('payment.process');

// Profile Routes
Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
});

// Customer Routes
Route::middleware('auth')->group(function() {
    Route::get('/home', [OutletController::class, 'customerDashboard'])->name('home');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    // Order History Routes
    Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order-history.index');
    Route::get('/order-history/{order}', [OrderHistoryController::class, 'show'])->name('order-history.show');

    // Outlet Routes
    Route::get('/outlets', [OutletController::class, 'index'])->name('outlets.index');
    Route::post('/outlets/{outlet}/favorite', [OutletController::class, 'toggleFavorite'])->name('outlets.toggleFavorite');
    Route::get('/favorite-outlets', [OutletController::class, 'favoriteOutlets'])->name('favorite.outlets');
    Route::get('/outlets/{outlet}', [OutletController::class, 'show'])->name('outlets.show');

    // Customer Lacak Pesanan Route
    Route::get('/lacak-pesanan', [PesananController::class, 'customerLacakPesanan'])->name('customer.lacak-pesanan');
});

// Admin Routes
Route::middleware('auth')->group(function() {
    // Admin Home Routes
    Route::get('/admin/home', [App\Http\Controllers\OutletController::class, 'dashboard'])->name('admin.home');

    // Admin Home Outlet Routes
    Route::get('/admin/homeoutlet', function () {
        return view('admin.homeoutlet');  // Make sure this view exists
    })->name('admin.homeoutlet');

    // Pesanan Routes
    Route::get('/tampil-pesanan', [PesananController::class, 'index'])->name('input.pesanan');
    Route::get('/pesanan/detail/{id}', [PesananController::class, 'show'])->name('pesanan.detail');
    Route::delete('/pesanan/hapus/{id}', [PesananController::class, 'destroy'])->name('pesanan.hapus');
    Route::put('/pesanan/update-status/{id}', [PesananController::class, 'updateStatus'])->name('pesanan.update-status');

    // Input Outlet Routes
    Route::get('/input-outlet', [OutletController::class, 'create'])->name('input.outlet');
    Route::post('/input-outlet', [OutletController::class, 'store'])->name('input.outlet.store');

    // Pelacakan Status Routes
    Route::get('/pelacakan-status', [PesananController::class, 'pelacakanStatus'])->name('pelacakan.status');
});

// Input Pesanan Routes
Route::middleware('auth')->get('/input-pesanan', [PesananController::class, 'create'])->name('input.pesanan');
Route::middleware('auth')->post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
Route::middleware('auth')->delete('/pesanan/hapus/{id}', [PesananController::class, 'destroy'])->name('pesanan.hapus');
Route::middleware('auth')->get('/pelacakan-status', [PesananController::class, 'pelacakanStatus'])->name('pelacakan.status');
Route::middleware('auth')->get('/pesanan/detail/{id}', [PesananController::class, 'show'])->name('pesanan.detail');

Route::middleware('auth')->group(function() {
    // Halaman Invoice
    Route::get('/admin/invoice/{id}', [PesananController::class, 'show'])->name('admin.invoice');
});

// Voucher

Route::get('/admin/vouchers/export', [VoucherController::class, 'exportCsv'])->name('admin.vouchers.export');
Route::middleware('auth')->group(function() {
    // Admin voucher routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/vouchers', [VoucherController::class, 'index'])->name('vouchers.index');
        Route::get('/vouchers/create', [VoucherController::class, 'create'])->name('vouchers.create');
        Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
        Route::get('/vouchers/{voucher}/edit', [VoucherController::class, 'edit'])->name('vouchers.edit');
        Route::put('/vouchers/{voucher}', [VoucherController::class, 'update'])->name('vouchers.update');
        Route::delete('/vouchers/{voucher}', [VoucherController::class, 'destroy'])->name('vouchers.destroy');
        Route::resource('vouchers', VoucherController::class);
    });
    
    // Customer voucher routes
    Route::get('/vouchers', [VoucherController::class, 'showAvailable'])->name('vouchers.available');
    Route::post('/vouchers/{voucher}/claim', [VoucherController::class, 'claim'])->name('vouchers.claim');
});

Route::resource('customers', CustomerController::class);