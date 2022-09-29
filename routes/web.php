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


    Route::get('/', [HomeController::class, 'index']);
    Route::get('/redirect', [HomeController::class, 'redirect']);
    // user
Route::prefix('users')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('users');
    Route::get('/delete/{id}', [UserController::class, 'destory'])->name('user.delete');;
    Route::get('/cart/info/{id}', [UserController::class, 'userCartIndex'])->name('user.cart.info');
    Route::get('/cart/remove/{id}', [UserController::class, 'userCartDestory'])->name('user.cart.remove');
    Route::post('/oreder/confirm', [UserController::class, 'userOrderConfirm'])->name('user.order.confirm');
});

// Auth Middleware
Route::middleware(['auth'])->group(function () {
    Route::post('/food/cart/{id}', [UserController::class, 'userFoodCart'])->name('user.food.cart');
    Route::post('/reservation', [UserController::class, 'store'])->name('user.reservation');
});


//  Admin 

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/food/create', [AdminController::class, 'create'])->name('admin.food.create');
    Route::post('/food/store', [AdminController::class, 'store'])->name('admin.food.store');
    Route::get('/food/delete/{id}', [AdminController::class, 'destory'])->name('admin.food.delete');
    Route::get('/food/edit/{id}', [AdminController::class, 'edit'])->name('admin.food.edit');
    Route::post('/food/update/{id}', [AdminController::class, 'update'])->name('admin.food.update');
    Route::get('/reservation', [AdminController::class, 'adminReservation'])->name('admin.reservation');
    Route::get('/status/{id}', [AdminController::class, 'adminStatus'])->name('admin.status');
    Route::get('/chefs', [AdminController::class, 'adminChefsIndex'])->name('admin.chefs');
    Route::post('/chefs/upload', [AdminController::class, 'adminChefsStore'])->name('admin.chefs.store');
    Route::get('/chefs/delete/{id}', [AdminController::class, 'adminChefsDestory'])->name('admin.chefs.delete');
    Route::get('/chefs/edit/{id}', [AdminController::class, 'adminChefsEdit'])->name('admin.chefs.edit');
    Route::post('/chefs/update/{id}', [AdminController::class, 'adminChefsUpdate'])->name('admin.chefs.update');
    Route::get('/oreder', [AdminController::class, 'adminOrder'])->name('admin.order');
    Route::get(md5('/search'), [AdminController::class, 'adminSearch'])->name('admin.search');
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
