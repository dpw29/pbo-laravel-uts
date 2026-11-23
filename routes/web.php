<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\BukuController;

// Redirect root ke halaman utama Inventaris Barang
Route::get('/', function () {
    return redirect()->route('barang.index');
});

/*
|--------------------------------------------------------------------------
| SOAL NO. 1 - ROUTING CRUD (Studi Kasus: Inventaris Barang)
|--------------------------------------------------------------------------
| Catatan Urutan: URI statis '/barang/create' wajib didefinisikan sebelum
| URI parameter dinamis '/barang/{kode}' agar 'create' tidak dianggap sebagai kode.
*/

Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{kode}', [BarangController::class, 'show'])->name('barang.show');
Route::get('/barang/{kode}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::match(['put', 'patch'], '/barang/{kode}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{kode}', [BarangController::class, 'destroy'])->name('barang.destroy');

/*
|--------------------------------------------------------------------------
| ROUTING ALIAS: /example (Sesuai penamaan spesifikasi tabel soal UTS)
|--------------------------------------------------------------------------
*/
Route::get('/example', [ExampleController::class, 'index'])->name('example.index');
Route::get('/example/create', [ExampleController::class, 'create'])->name('example.create');
Route::post('/example', [ExampleController::class, 'store'])->name('example.store');
Route::get('/example/{kode}', [ExampleController::class, 'show'])->name('example.show');
Route::get('/example/{kode}/edit', [ExampleController::class, 'edit'])->name('example.edit');
Route::match(['put', 'patch'], '/example/{kode}', [ExampleController::class, 'update'])->name('example.update');
Route::delete('/example/{kode}', [ExampleController::class, 'destroy'])->name('example.destroy');

/*
|--------------------------------------------------------------------------
| Praktikum Sebelumnya (Portal Buku)
|--------------------------------------------------------------------------
*/
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');
Route::get('/kategori/{nama?}', [BukuController::class, 'kategori'])->name('buku.kategori');
