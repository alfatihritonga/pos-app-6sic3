<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SayHelloController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/say-hello', function() {
    return "Helloo";
});

// Route::get('/say-hello/{name}', function($name) {
//     return "Hello " . $name;
// });

Route::get('/say-hello/{name}', [SayHelloController::class, 'sayHello']);

Route::get('/home', function() {
    return "Ini halaman home";
});

// Route::get('/category', [CategoryController::class, 'index']);
Route::resource('category', CategoryController::class);

Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/{productId}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/{productId}/update', [ProductController::class, 'update'])->name('product.update');
Route::delete('product/{productId}/delete', [ProductController::class, 'destroy'])->name('product.destroy');

// route transaksi
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('transaction/cart/add', [TransactionController::class, 'addToCart'])->name('transaction.cart.add');
Route::post('transaction/update', [TransactionController::class, 'updateCart'])->name('transaction.cart.update');
Route::get('transaction/cancel/{id}', [TransactionController::class, 'removeFromCart'])->name('transaction.cart.remove');
Route::get('transaction/cancel', [TransactionController::class, 'cancel'])->name('transaction.cancel');
Route::post('transaction/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout');


// route detail transaksi
Route::get('transaction/detail/{id}', [DetailTransactionController::class, 'showDetail'])->name('transaction.detail');

// route cetak laporan
Route::get('transaction/print/{id}', [DetailTransactionController::class, 'print'])->name('transaction.print');