<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TinTucAdminController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TinTucController;

// [Bài tập 06]: Route xem danh sách tin tức và xem chi tiết tin tức ngoài Frontend bằng Slug/ID
Route::get('/', [TinTucController::class, 'index'])->name('tin.index');
Route::get('/tin/{id}', [TinTucController::class, 'show'])->name('tin.show');

// [Bài tập 01 & 08]: Chuyển hướng dashboard sau đăng nhập về trang chủ
Route::get('/dashboard', fn() => redirect()->route('tin.index'))->middleware(['auth', 'verified'])->name('dashboard');

// [Bài tập 01]: Nhóm route Profile cá nhân
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// [Bài tập 01 & 08]: Nhóm route Admin - Bảo vệ bằng middleware Auth và Role Admin (CheckRole)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // [Bài tập 04]: Trang chủ quản trị chuyển hướng đến Dashboard
    Route::get('/', fn() => redirect()->route('admin.dashboard'))->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // [Bài tập 03 & 05 & 06 & 07]: Resource quản lý Tin tức (Resource Controller)
    Route::resource('tin', TinTucAdminController::class);
    Route::resource('tintuc', TinTucAdminController::class);
    
    // [Bài tập 02]: Resource quản lý Danh mục
    Route::resource('danhmuc', DanhMucController::class);
    
    // [Bài tập 07]: Route xóa ảnh phụ Gallery của bài viết
    Route::delete('tin/gallery/{id}', [TinTucAdminController::class, 'deleteImage'])->name('tin.delete-image');
    
    // [Bài tập 03]: Route phục hồi (restore) và xóa vĩnh viễn (forceDelete) cho SoftDeletes
    Route::post('tin/{id}/restore', [TinTucAdminController::class,'restore'])->name('tin.restore');
    Route::delete('tin/{id}/force', [TinTucAdminController::class, 'forceDelete'])->name('tin.force-delete');
    Route::post('tintuc/{id}/restore', [TinTucAdminController::class,'restore'])->name('tintuc.restore');
    Route::delete('tintuc/{id}/force', [TinTucAdminController::class, 'forceDelete'])->name('tintuc.force-delete');
});

require __DIR__.'/auth.php';
