<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukGaleriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register' => false]);

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('produk/{id}/galeri-produk', [ProdukController::class, 'galeri'])->name('produk.galeri');
Route::resource('produk', ProdukController::class);
Route::resource('foto-produk', ProdukGaleriController::class);

