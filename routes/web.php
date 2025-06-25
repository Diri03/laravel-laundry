<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [App\Http\Controllers\LoginController::class, 'login'] )->name('login');
Route::get("logout", [App\Http\Controllers\LoginController::class, 'logout'] )->name('logout');

Route::middleware(['auth'])->group(function(){
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    Route::get('service', [App\Http\Controllers\DashboardController::class, 'serviceIndex'])->name('service');
    Route::get('insert/service', [App\Http\Controllers\DashboardController::class, 'insertService']);

});

Route::post("actionLogin", [App\Http\Controllers\LoginController::class, 'actionLogin'] )->name('actionLogin');