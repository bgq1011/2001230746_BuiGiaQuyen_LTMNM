<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdvancedController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/advanced', [AdvancedController::class, 'index'])->name('advanced.index');
