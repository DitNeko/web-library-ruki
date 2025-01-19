<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('/manajemen', BookController::class)->names([
        'index' => 'manajemen.buku',
        'create' => 'tambah.buku',
        'store' => 'store.buku',
        'edit' => 'edit.buku',
        'update' => 'update.buku',
        'destroy' => 'delete.buku'
    ]);
    Route::resource('/peminjaman', LoanController::class)->names([
        'index' => 'peminjaman.buku',
        'create' => 'tambah.peminjaman',
        'store' => 'store.peminjaman',
        'edit' => 'edit.peminjaman',
        'update' => 'update.peminjaman',
        'destroy' => 'delete.peminjaman'
    ]);
    Route::get('/pengembalian', [ReturnController::class, 'index'])->name('pengembalian.buku');
    Route::post('/pengembalian/kembalikan/{id}', [ReturnController::class, 'returnBook'])->name('kembalikan.buku');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
