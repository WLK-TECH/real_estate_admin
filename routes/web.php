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

    Route::resource('/super-admins', SuperAdminController::class);
    Route::resource('/admins', AdminController::class);
    Route::resource('/users', UserController::class);

    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
});



require __DIR__.'/auth.php';
