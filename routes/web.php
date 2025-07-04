<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [App\Http\Controllers\LoginController::class, 'login'] )->name('login');
Route::get("logout", [App\Http\Controllers\LoginController::class, 'logout'] )->name('logout');

Route::middleware(['auth'])->group(function(){
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    Route::resource('level', App\Http\Controllers\LevelController::class);
    Route::resource('service', App\Http\Controllers\ServiceController::class);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('order', App\Http\Controllers\TransOrdersController::class);
    Route::resource('product', App\Http\Controllers\ProductController::class);
    Route::get("print_struk/{id}", [App\Http\Controllers\TransOrdersController::class, 'printStruk'] )->name('print_struk');
    
    Route::post("order/{id}/snap", [App\Http\Controllers\TransOrdersController::class, 'snap'] )->name('order.snap');


});

Route::post("actionLogin", [App\Http\Controllers\LoginController::class, 'actionLogin'] )->name('actionLogin');