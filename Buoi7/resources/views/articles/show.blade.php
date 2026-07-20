@extends('layouts.app')
@section('title', 'Chi tiết bài viết')
@section('content')
<h2>Chi tiết bài viết</h2>
<p><strong>ID:</strong> {{ $article->id }}</p>
<p><strong>Tiêu đề:</strong> {{ $article->title }}</p>
<p><strong>Nội dung:</strong> {{ $article->body }}</p>
<a href="{{ route('articles.index') }}">Quay lại danh sách</a>
@endsection
