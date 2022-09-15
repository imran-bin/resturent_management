<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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
Route::get('/',[HomeController::class,'index']);
Route::get('/redirect',[HomeController::class,'redirect']);
Route::get('users',[AdminController::class,'users'])->name('users');
Route::get('users/delete/{id}',[AdminController::class,'users_delete'])->name('user.delete');
Route::get('admin/food/create',[AdminController::class,'food_create'])->name('admin.food_create');
Route::post('admin/food/store',[AdminController::class,'food_store'])->name('admin.food_upload');
Route::get('admin/food/delete/{id}',[AdminController::class,'food_delete'])->name('admin.food.delete');
Route::get('admin/food/edit/{id}',[AdminController::class,'food_edit'])->name('admin.food.edit');
Route::post('admin/food/update/{id}',[AdminController::class,'food_update'])->name('admin.food_update');
Route::post('user/reservation',[AdminController::class,'user_reservation'])->name('user.reservation');
Route::get('admin/reservation',[AdminController::class,'admin_reservation'])->name('admin.reservation');
Route::get('admin/status/{id}',[AdminController::class,'admin_status'])->name('admin.status');
Route::get('admin/chefs',[AdminController::class,'admin_chefs'])->name('admin.chefs');
Route::post('admin/chefs/upload',[AdminController::class,'admin_chefs_upload'])->name('admin.chefs_upload');
Route::get('admin/chefs/delete/{id}',[AdminController::class,'admin_chefs_delete'])->name('admin.chefs.delete');
Route::get('admin/chefs/edit/{id}',[AdminController::class,'admin_chefs_edit'])->name('admin.chefs.edit');
Route::post('admin/chefs/update/{id}',[AdminController::class,'admin_chefs_update'])->name('admin.chefs_update');
Route::post('user/food/cart/{id}',[AdminController::class,'user_food_cart'])->name('user.food.cart');
Route::get('user/cart/info/{id}',[AdminController::class,'user_cart_info'])->name('user.cart.info');
Route::get('user/cart/remove/{id}',[AdminController::class,'user_cart_remove'])->name('user.cart.remove');
Route::post('user/oreder/confirm',[AdminController::class,'user_order_confirm'])->name('user.order_confirm');
Route::get('admin/oreder',[AdminController::class,'admin_order'])->name('admin.order');
Route::get(md5('admin/search')  ,[AdminController::class,'admin_search'])->name('admin.search');
 
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
