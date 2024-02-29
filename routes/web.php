<?php

use App\Http\Controllers\Admin\User\AdminController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\SuperAdminController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\HomeController;
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
