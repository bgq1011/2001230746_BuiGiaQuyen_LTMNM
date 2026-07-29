<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $data['image_path'] = $path;
        }

        Article::create($data);

        return redirect()->route('articles.index')
            ->with('success', 'Tạo bài viết thành công.');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(StoreArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Xoá ảnh cũ (nếu có)
            if (!empty($article->image_path) && \Storage::disk('public')->exists($article->image_path)) {
                \Storage::disk('public')->delete($article->image_path);
            }
            $data['image_path'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('articles.index')
            ->with('success', 'Cập nhật bài viết thành công.');
    }

    public function destroy(Article $article)
    {
        if (!empty($article->image_path) && \Storage::disk('public')->exists($article->image_path)) {
            \Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Xóa bài viết thành công.');
    }
}
