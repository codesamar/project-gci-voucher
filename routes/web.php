<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\KeranjangController;


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


Route::get('/', [BarangController::class, 'index']);

Route::get('/akun', [VoucherController::class, 'index']);

Route::get('/masukkeranjang', [KeranjangController::class, 'store']);

Route::get('/keranjang', [KeranjangController::class, 'index']);

Route::get('/pakaivoucher', [KeranjangController::class, 'pakaivoucher']);

Route::get('/batalvoucher', [KeranjangController::class, 'batalvoucher']);

Route::get('/checkout', [KeranjangController::class, 'checkout']);
