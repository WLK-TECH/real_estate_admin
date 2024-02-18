<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:super admin|admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class,'index'])->name('home');

    Route::resource('/super-admin', SuperAdminController::class);
    Route::resource('/admin', AdminController::class);
    Route::resource('/user', UserController::class);

    Route::resource('/role', RoleController::class);
    Route::resource('/permission', PermissionController::class);
});



require __DIR__.'/auth.php';
