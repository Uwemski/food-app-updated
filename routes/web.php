<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('about', function(){
    return view('about');
})->name('about');
Route::get('contact', function(){
    return view('contact');
})->name('contact');

// Route::get('admin', function(){
//     return view('admin_dashboard');
// })->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin middleware
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/create-category', [CategoryController::class, 'index'])->name('category.create');
Route::post('/admin/create-category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/view-category', [CategoryController::class, 'show'])->name('category.show');//without middleware

Route::get('/admin/create-product', [ProductController::class, 'index'])->name('product.create');
Route::post('/admin/create-product', [ProductController::class, 'store'])->name('product.store');
Route::get('/admin/products', [ProductController::class, 'show'])->name('products.show');
Route::patch('/admin/{product}/availability', [ProductController::class, 'updateAvailability'])->name('product.updateAvailability');
Route::patch('/admin/{product}/quantity', [ProductController::class, 'updateQuantity'])->name('product.updateQuantity');
Route::post('/admin/{product}/remove', [ProductController::class, 'remove'])->name('product.remove');
Route::post('/admin/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');

Route::DELETE('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/view', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/delete/{id}', [CartController::class, 'remove'])->name('cart.delete');


//checkout controller
Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/cart/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// middleware admin && attendants
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.view');
Route::get('/admin/order/{order}', [OrderController::class, 'show'])->name('orders.show');

Route::get('/products', [ProductController::class, 'guestIndex'])->name('products.index');
//admin middleware
Route::put('/admin/order/{order}/update/payment', [OrderController::class, 'updatePayment'])->name('payment.update');
Route::patch('/admin/order/{order}/status', [OrderController::class, 'updateStatus'])->name('status.update');
require __DIR__.'/auth.php';