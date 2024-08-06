<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\historyController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\keuangansController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\payController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\userController;
use App\Models\history;
use Illuminate\Support\Facades\Route;



Route::fallback(function () {
    return redirect('/');
});


Route::get('/', [indexController::class, 'home']);


// auth proses
Route::get('login', [authController::class, 'login']);
Route::post('login', [authController::class, 'validasi']);
Route::get('register', [authController::class, 'registers']);
Route::post('register', [authController::class, 'register']);
Route::get('logout', [authController::class, 'logout']);


// order proses
Route::get('order/{id}', [orderController::class, 'index']);
Route::post('addcart', [orderController::class, 'createCart']);
Route::get('cart', [orderController::class, 'cart']);
Route::post('checkout', [orderController::class, 'checkout']);
Route::get('invoicePanding/{id}', [orderController::class, 'invoice']);
Route::get('invoice-history/{id}', [orderController::class, 'invoice']);
Route::get('panding', [orderController::class, 'panding']);
Route::get('invoice/{id}', [orderController::class, 'downloadInvoicePDF']);
Route::get('invoice-print/{id}', [orderController::class, 'print']);
Route::get('daftartanggal/{id}', [orderController::class, 'daftartanggal']);
Route::post('daftartanggal/{id}', [orderController::class, 'daftartanggal']);
Route::post('refund/{id}', [orderController::class, 'refund']);


// pay controller
Route::post('pay/{id}', [payController::class, 'pay']);

// history controller user
Route::get('history', [historyController::class, 'indexUser']);
Route::get('selesai/{id}', [historyController::class, 'doneOrder']);


// akses hanya untuk admin dan gudang
Route::group(['middleware' => ['role:admin,gudang']], function () {
    // dashboard admin
    Route::get('admin', [indexController::class, 'index']);

    // kategori page
    Route::get('kategori', [kategoriController::class, 'index']);
    Route::post('addkategori', [kategoriController::class, 'create']);
    Route::post('editkategori/{id}', [kategoriController::class, 'edit']);
    Route::get('terkait/{id}', [kategoriController::class, 'terkait']);
    Route::delete('deletekategori/{id}', [kategoriController::class, 'delete']);

    // produk page
    Route::get('produk', [produkController::class, 'index']);
    Route::post('addproduk', [produkController::class, 'create']);
    Route::post('editproduk/{id}', [produkController::class, 'edit']);
    Route::delete('deleteproduk/{id}', [produkController::class, 'delete']);
    Route::post('maintenance/{id}', [produkController::class, 'maintenance']);

    // order page
    Route::get('order-page', [orderController::class, 'admin']);
    Route::delete('order-delete', [orderController::class, 'delete']);

    // pay controller
    Route::post('invoice-confirm', [payController::class, 'invoiceConfirm']);

    
    // history page
    Route::get('history-admin', [historyController::class, 'indexAdmin']);

    // history keuangan page
    Route::get('record', [keuangansController::class, 'index']);
    Route::post('addkeuangan', [keuangansController::class, 'create']);
    Route::post('editcatatan/{id}', [keuangansController::class, 'edit']);
});


// akses hanya untuk admin
Route::group(['middleware' => ['role:admin']], function () {
    // dashboard admin
    Route::get('admin', [indexController::class, 'index']);
    // user page
    Route::get('user', [userController::class, 'user']);
    Route::post('edituser/{id}', [userController::class, 'edit']);
    Route::post('adduser', [userController::class, 'create']);
    Route::delete('deleteuser/{id}', [userController::class, 'delete']);  
});


