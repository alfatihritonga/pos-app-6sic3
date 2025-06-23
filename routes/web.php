<?php

use App\Http\Controllers\CategoryController;
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

Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('transaction/cart/add', [TransactionController::class, 'addToCart'])->name('transaction.cart.add');
// Route::post('transaction/cart/update', [TransactionController::class, 'addToCart'])->name('transaction.cart.update');
// Route::post('transaction/cart/delete', [TransactionController::class, 'addToCart'])->name('transaction.cart.delete');
