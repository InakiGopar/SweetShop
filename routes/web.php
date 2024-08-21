<?php

use App\Http\Controllers\order\OrderController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\ProfileController;
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
})->middleware('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//orders routes
Route::get('/pedidos', [OrderController::class, 'showOrders'])->name('order.orders');
Route::get('/pedidos/crear', [OrderController::class, 'createOrder'])->name('order.create');
Route::post('/pedidos/crear', [OrderController::class, 'storeOrder'])->name('order.store');
Route::get('/pedido/{order}', [OrderController::class, 'showOrder'])->name('order.show');
Route::get('/pedidos/editar/{order}', [OrderController::class, 'editOrder'])->name('order.edit');
Route::put('/pedidos/actualizar/{order}', [OrderController::class, 'updateOrder'])->name('order.update');
Route::delete('/pedidos/eliminar/{order}', [OrderController::class, 'deleteOrder'])->name('order.delete');

//products routes
Route::get('/productos', [ProductController::class, 'showProducts'])->name('product.products');
Route::get('/productos/crear', [ProductController::class, 'createProduct'])->name('product.create');
Route::post('/productos/crear', [ProductController::class, 'storeProduct'])->name('product.store');
Route::get('/productos/{product}', [ProductController::class, 'showProduct'])->name('product.show');
Route::get('/productos/editar/{product}', [ProductController::class, 'editProduct'])->name('product.edit');
Route::put('/productos/actualizar/{product}', [ProductController::class, 'updateProduct'])->name('product.update');
Route::delete('/productos/eliminar/{product}', [ProductController::class, 'deleteProduct'])->name('product.delete');