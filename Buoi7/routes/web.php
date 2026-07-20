<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Bài 01: Routing nâng cao
Route::get('/articles/page/{page}', function ($page) {
    return 'Trang bài viết số: ' . (int) $page;
})->whereNumber('page')->name('articles.page');

Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return 'Slug: ' . $slug;
})->where('slug', '[a-z0-9-]+');

Route::prefix('admin')->group(function () {
    Route::get('/articles', fn() => 'Quản trị bài viết')
        ->name('admin.articles.index');
});

// Bài 02: Resource routes cho Article
Route::resource('articles', ArticleController::class);

// Bài 06: Route model binding implicit
Route::get('/articles/show/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Bài 07: Delete form an toàn (confirm + method spoofing)
// Form xoá đã được dùng trong view articles.index

// Bài 08: UI nâng cấp
// Component <x-button> và CSS nhỏ dùng @push('styles') đã áp dụng ở create/edit

// Bài 09: Named routes + breadcrumb
// Các link trong view đã dùng route('articles.index') / route('articles.create')

Route::get('/', function () {
    return view('welcome');
});

