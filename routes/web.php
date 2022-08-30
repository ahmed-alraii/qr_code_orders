<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/' , [RestaurantController::class , 'indexCards'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/menu_items' , MenuItemController::class);
Route::resource('/restaurants' , RestaurantController::class);
Route::get('/menu_items_cards', [MenuItemController::class , 'indexCards'])->name('menu_items_cards');
Route::get('/restaurants_cards', [RestaurantController::class , 'indexCards'])->name('restaurants_cards');
Route::post('add_user' , [AdminController::class , 'addUser'])->name('add_user');
Route::get('/add_qr_code', [AdminController::class , 'showQrCodeForm'])->name('add_qr_code');
Route::post('/generate_qr_code', [AdminController::class , 'generateQrCode'])->name('generate_qr_code');
Route::post('/cart_store', [CartController::class , 'store'])->name('cart_store');
Route::post('/cart_remove', [CartController::class , 'remove'])->name('cart_remove');
