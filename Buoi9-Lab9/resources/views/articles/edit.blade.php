@extends('layouts.app')

@section('title', 'Sửa Bài Viết')

@section('styles')
<style>
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    input[type="text"], textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-family: inherit;
    }
    textarea {
        height: 120px;
    }
    .error-msg {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
    }
    .btn-submit {
        padding: 10px 15px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }
    .btn-submit:hover {
        background-color: #218838;
    }
</style>
@endsection

@section('content')
<h3>Sửa bài viết</h3>

<form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Tiêu đề</label>
        <input type="text" name="title" value="{{ old('title', $article->title) }}">
        @error('title')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Thẻ (Tags)</label>
        <input type="text" name="tags" value="{{ old('tags', $article->tags) }}">
        @error('tags')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Nội dung</label>
        <textarea name="body">{{ old('body', $article->body) }}</textarea>
        @error('body')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label>Ảnh minh hoạ (tuỳ chọn)</label>
        @if(!empty($article->image_path))
            <div style="margin-bottom: 10px;">
                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh minh hoạ" style="max-width: 150px; display: block; border: 1px solid #ccc; padding: 3px; margin-top: 5px;">
                <span style="font-size: 0.85em; color: #666;">Ảnh hiện tại</span>
            </div>
        @endif
        <input type="file" name="image" accept=".jpg,.jpeg,.png">
        @error('image')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-submit">Cập nhật</button>
</form>
@endsection
