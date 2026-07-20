<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Bài 02: RESTful controller - danh sách bài viết
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = [
            ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội
            dung A'],
            ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung
            B'],
            ];
        return view('articles.index', compact('articles'));
    }

    // Bài 05: Form tạo mới bài viết
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required','string','max:255'],
            'body' => ['required','string','min:10'],
        ]);
        //khai báo file name
        $fileName = 'article_' . time() . '.txt';
        //khai báo nội dung file
        $content = "Title: {$validated['title']}\nBody: {$validated['body']}\n";
        //hàm lưu trữ file vào storage/app/public
        file_put_contents(storage_path('app/public/' . $fileName), $content);

        //trả về index articles và thông báo tạo bài viết thành công
        return redirect()->route('articles.index')
            ->with('success', 'Tạo bài viết thành công (demo). File đã được lưu tại storage/app/public/' . $fileName);
    }

    // Bài 06: Route model binding implicit
    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            // Tạm dữ liệu mẫu
        $article = ['id' => $id, 'title' => 'Tiêu đề mẫu', 'body' => 'Nội dung mẫu'];
        return view('articles.edit', compact('article'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:10'],
            ]);
            return redirect()->route('articles.index')
            ->with('success', "Cập nhật bài viết #$id thành công (demo).");
    }

    // Bài 07: Xoá an toàn (demo)
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('articles.index')
            ->with('success', "Đã xóa bài viết #$id (demo).");
    }
}
