<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;



Route::get('/',[HomeController::class, 'home']);
Route::get('/dashboard',[HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('add_cart/{id}',[HomeController::class,'add_cart'])->middleware(['auth', 'verified']);
Route::get('mycart',[HomeController::class,'mycart'])->middleware(['auth', 'verified']);
Route::get('del_cart/{id}',[HomeController::class,'del_cart'])->middleware(['auth', 'verified']);
Route::post('confirm_order',[HomeController::class,'confirm_order'])->middleware(['auth', 'verified']);

Route::get('myorders',[HomeController::class,'myorders'])->middleware(['auth', 'verified']);





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


route::get('admin/dashboard',[HomeController::class,'admin_home'])->middleware(['auth','admin']);
route::get('view_kategori',[AdminController::class,'view_kategori'])->middleware(['auth','admin']);
route::post('add_kategori',[AdminController::class,'add_kategori'])->middleware(['auth','admin']);
route::get('hapus_kategori/{id}',[AdminController::class,'hapus_kategori'])->middleware(['auth','admin']);
route::post('edit_kategori/{id}',[AdminController::class,'edit_kategori'])->middleware(['auth','admin']);

route::get('add_produk',[AdminController::class,'add_produk'])->middleware(['auth','admin']);
route::post('upload_produk',[AdminController::class,'upload_produk'])->middleware(['auth','admin']);
route::get('hapus_produk/{id}',[AdminController::class,'hapus_produk'])->middleware(['auth','admin']);
route::post('update_produk/{id}',[AdminController::class,'update_produk'])->middleware(['auth','admin']);
Route::get('view_order',[AdminController::class,'view_order'])->middleware(['auth', 'admin']);
Route::get('otw/{id}',[AdminController::class,'otw'])->middleware(['auth', 'admin']);
Route::get('delivered/{id}',[AdminController::class,'delivered'])->middleware(['auth', 'admin']);

route::get('details/{id}',[HomeController::class,'details']);
