<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect trang chủ về trang danh sách bài viết
Route::get('/', function () {
    return redirect()->route('articles.index');
});

// Route xem danh sách bài viết: công khai (không cần đăng nhập)
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Nhóm route quản trị (tạo, lưu bài viết): yêu cầu đăng nhập & đã xác minh email (verified)
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    // Route sửa, cập nhật, xóa: yêu cầu là tác giả (author middleware)
    Route::middleware(['author'])->group(function () {
        Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    });
});

// Route test ngoại lệ CSRF (Webhook / Payment Callback)
Route::post('/payment/callback', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Nhận webhook/callback thành công mà không cần mã CSRF token!'
    ]);
});

// Cấu hình throttle giới hạn tần suất gửi yêu cầu (Ví dụ: tối đa 5 yêu cầu/phút)
Route::middleware(['throttle:5,1'])->group(function () {
    Route::get('/public-info', function () {
        return response()->json(['status' => 'ok', 'message' => 'Yêu cầu thành công.']);
    });
});

// --- Các route sinh ra bởi Laravel Breeze ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
