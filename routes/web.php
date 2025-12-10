<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Hanya untuk user yang login
Route::middleware('auth')->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    // Logout
Route::post('/logout', function (Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
});

// existing routes...

// Pastikan route /order memakai middleware auth (sesuai kebutuhan)
Route::middleware('auth')->group(function () {
    // Tampilkan form order (GET) — menerima query ?menu=...&harga=...
    Route::get('/order', [OrderController::class, 'index'])->name('order');

    // Submit order (POST) — menyimpan order dan memanggil Midtrans
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');

    // Endpoint untuk membuat transaksi midtrans (dipanggil dari store internal jika perlu)
    Route::post('/payment/create', [OrderController::class, 'createPayment'])->name('payment.create');

    // Cek status transaksi Midtrans (AJAX)
    Route::get('/payment/status/{order_id}', [OrderController::class, 'checkStatus'])->name('payment.status');

    // Halaman sukses setelah pembayaran terkonfirmasi
    Route::get('/order/success/{order_id}', [OrderController::class, 'success'])->name('order.success');
});

// Halaman menu lainnya
Route::get('/menu-lainnya', [MenuController::class, 'index'])->name('menu.lainnya');

// Halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

// Proses login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Email atau kata sandi salah.',
    ]);
});

// Halaman register
Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

// Proses register
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
    ]);

    // Simpan user baru
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Redirect ke halaman login dengan pesan sukses
    return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
});

require __DIR__ . '/auth.php';

// Add missing routes for auth controllers
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

    // Menu Management
    Route::get('/menus', [App\Http\Controllers\AdminController::class, 'menus'])->name('menus');
    Route::get('/menus/create', [App\Http\Controllers\AdminController::class, 'createMenu'])->name('menus.create');
    Route::post('/menus', [App\Http\Controllers\AdminController::class, 'storeMenu'])->name('menus.store');
    Route::get('/menus/{id}/edit', [App\Http\Controllers\AdminController::class, 'editMenu'])->name('menus.edit');
    Route::put('/menus/{id}', [App\Http\Controllers\AdminController::class, 'updateMenu'])->name('menus.update');
    Route::delete('/menus/{id}', [App\Http\Controllers\AdminController::class, 'deleteMenu'])->name('menus.delete');

    // Order Management
    Route::get('/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('orders');
    Route::post('/orders/{id}/status', [App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('orders.update-status');

    // Reports
    Route::get('/reports', [App\Http\Controllers\AdminController::class, 'reports'])->name('reports');
});
