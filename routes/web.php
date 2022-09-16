<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/redirect', [HomeController::class, 'redirect']);
Route::prefix('users')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('users');
    Route::get('/delete/{id}', [UserController::class, 'destory'])->name('user.delete');
    Route::post('/reservation', [UserController::class, 'store'])->name('user.reservation');
    Route::post('/food/cart/{id}', [UserController::class, 'user_food_cart'])->name('user.food.cart');
    Route::get('/cart/info/{id}', [UserController::class, 'user_cart_index'])->name('user.cart.info');
    Route::get('/cart/remove/{id}', [UserController::class, 'user_cart_destory'])->name('user.cart.remove');
    Route::post('/oreder/confirm', [UserController::class, 'user_order_confirm'])->name('user.order_confirm');
});
Route::prefix('admin')->group(function () {
    Route::get('/food/create', [AdminController::class, 'create'])->name('admin.food_create');
    Route::post('/food/store', [AdminController::class, 'store'])->name('admin.food_upload');
    Route::get('/food/delete/{id}', [AdminController::class, 'delete'])->name('admin.food.delete');
    Route::get('/food/edit/{id}', [AdminController::class, 'edit'])->name('admin.food.edit');
    Route::post('/food/update/{id}', [AdminController::class, 'update'])->name('admin.food_update');
    Route::get('/reservation', [AdminController::class, 'admin_reservation'])->name('admin.reservation');
    Route::get('/status/{id}', [AdminController::class, 'admin_status'])->name('admin.status');
    Route::get('/chefs', [AdminController::class, 'admin_chefs_index'])->name('admin.chefs');
    Route::post('/chefs/upload', [AdminController::class, 'admin_chefs_store'])->name('admin.chefs_upload');
    Route::get('/chefs/delete/{id}', [AdminController::class, 'admin_chefs_destory'])->name('admin.chefs.delete');
    Route::get('/chefs/edit/{id}', [AdminController::class, 'admin_chefs_edit'])->name('admin.chefs.edit');
    Route::post('/chefs/update/{id}', [AdminController::class, 'admin_chefs_update'])->name('admin.chefs_update');
    Route::get('/oreder', [AdminController::class, 'admin_order'])->name('admin.order');
    Route::get(md5('/search'), [AdminController::class, 'admin_search'])->name('admin.search');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
