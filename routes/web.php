<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Bài 02: route cơ bản và xử lý dữ liệu PHP thuần
Route::get('/hello', function () {
    return 'Xin chào Laravel 12!';
});

Route::get('/time', function () {
    // Dùng helper now() để định dạng thời gian hệ thống
    return now()->format('H:i:s d/m/Y');
});

Route::get('/sum/{a}/{b}', function ($a, $b) {
    if (!is_numeric($a) || !is_numeric($b)) {
        return response('Tham số phải là số nguyên', 400);
    }

    return (int) $a + (int) $b;
});

Route::get('/', function () {
    return view('welcome');
});

// Bài 07: controller, Eloquent, phân trang và blade mở rộng
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about']);

// Bài 08: form tạo mới sinh viên
Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students', [StudentController::class, 'store']);

Route::get('/students', [StudentController::class, 'index']);

Route::get('/students/db', [StudentController::class, 'indexDb']);
Route::get('/students/combined', [StudentController::class, 'combined']);