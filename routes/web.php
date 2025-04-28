<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Auth;

Route::get('/', [BarangController::class, 'index']);

Route::get('/dashboard', function () {
    $pembelians = Pembelian::with('barang')->where('user_id', Auth::id())->get();
    return view('dashboard', compact('pembelians'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/barangs/jual', [BarangController::class, 'jual'])->name('barangs.jual');
    Route::post('/barangs/{id}/beli', [PembelianController::class, 'beli'])->name('barangs.beli');
    Route::delete('/pembelians/{id}', [PembelianController::class, 'destroy'])->name('pembelians.destroy');

    Route::resource('barangs', BarangController::class)->except(['show', 'edit']);
    
    Route::get('/barangs/{id}', [BarangController::class, 'show'])->name('barangs.show');
    Route::get('/barangs/{id}/edit', [BarangController::class, 'edit'])->name('barangs.edit');
    Route::put('/barangs/{id}', [BarangController::class, 'update'])->name('barangs.update');
});

require __DIR__.'/auth.php';
