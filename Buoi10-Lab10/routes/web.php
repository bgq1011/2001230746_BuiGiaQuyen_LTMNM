<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\AdminTinTucController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [TinTucController::class, 'index'])->name('tin.index');
Route::get('/tin/{id}', [TinTucController::class, 'show'])->name('tin.show');

// Admin Routes (Giao diện Quản trị)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tin-tuc', [AdminTinTucController::class, 'index'])->name('tintuc.index');
    Route::get('/tin-tuc/create', [AdminTinTucController::class, 'create'])->name('tintuc.create');
    Route::get('/tin-tuc/{id}/edit', [AdminTinTucController::class, 'edit'])->name('tintuc.edit');
});
