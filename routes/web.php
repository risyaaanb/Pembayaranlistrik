<?php

use App\Exports\PenggunaanExport;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganDashboardController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenggunaanListrikController;
use App\Http\Controllers\ProfileController;
use App\Models\Pelanggan;
use App\Models\PenggunaanListrik;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? view('admin.dashboard')
        : view('pelanggan.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('/admin/pelanggan', PelangganController::class)->middleware('auth')->names('pelanggan');
Route::resource('/admin/penggunaan', PenggunaanListrikController::class)->middleware('auth')->names('penggunaan');

Route::get('/admin/penggunaan/export/excel', function (Illuminate\Http\Request $request) {
    $bulan = $request->get('bulan');
    $tahun = $request->get('tahun');

    return Excel::download(new PenggunaanExport($bulan, $tahun), 'penggunaan_listrik.xlsx');
})->middleware('auth');

Route::get('/admin/rekap-kwh', [\App\Http\Controllers\PenggunaanListrikController::class, 'rekap'])
    ->name('rekap.kwh')->middleware('auth');
    Route::get('/admin/tagihan', [\App\Http\Controllers\AdminTagihanController::class, 'index'])->name('admin.tagihan')->middleware('auth');


    Route::resource('/admin/pembayaran', PembayaranController::class)->middleware('auth')->names('pembayaran');
    
    Route::middleware(['auth', 'pelanggan'])->prefix('pelanggan')->group(function () {
    Route::get('/dashboard', [PelangganDashboardController::class, 'dashboard'])->name('pelanggan.dashboard');
    Route::get('/riwayat-penggunaan', [PelangganDashboardController::class, 'riwayat'])->name('pelanggan.riwayat');
    Route::get('/tagihan', [PelangganDashboardController::class, 'tagihan'])->name('pelanggan.tagihan');
    Route::get('/profil/edit', [PelangganDashboardController::class, 'editProfil'])->name('pelanggan.profil.edit');
    Route::post('/profil', [PelangganDashboardController::class, 'updateProfil'])->name('pelanggan.profil.update');
    Route::get('/profil', [PelangganDashboardController::class, 'profil'])->name('pelanggan.profil');


    Route::get('/bayar/{id}', [PelangganDashboardController::class, 'bayar'])->name('pelanggan.bayar');
    Route::post('/bayar/{id}', [PelangganDashboardController::class, 'storePembayaran'])->name('pelanggan.bayar.store');
    Route::get('/struk/{id}', [PelangganDashboardController::class, 'struk'])->name('pelanggan.struk');

});



require __DIR__.'/auth.php';
