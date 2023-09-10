<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;

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


Route::controller(ProductsController::class)->group(function(){
    Route::get('/', 'index')->name('home');
    Route::get('/product/{product:slug}', 'view')->name('product.view');
});

Route::middleware('auth')->group(function(){

    Route::controller(CartController::class)->group(function(){
        Route::get('/cart', 'index')->name('cart');
        Route::get('add/cart/{id}', 'view')->name('add.cart');
        Route::post('save/cart/{id}', 'store')->name('save.cart');
        Route::get('delete/cart/{id}', 'destroy')->name('delete.cart');
        Route::post('cart/checkout', 'cartCheckout')->name('cart.checkout');
    });

    Route::controller(OrdersController::class)->group(function(){
        Route::get('/orders/index', 'index')->name('orders.index');
    });

});

Route::middleware(['auth','verified'])->group(function(){

    Route::controller(UserController::class)->group(function(){
        Route::get('/profile/home', 'index')->name('profile.home');
        Route::post('/pwd/update', 'pwdUpdate')->name('pwd.update');
    });
});
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
