@extends('layouts.app')

@section('title', 'Danh sách Bài Viết')

@section('styles')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .btn {
        padding: 5px 10px;
        text-decoration: none;
        background-color: #0066cc;
        color: white;
        border-radius: 3px;
        font-size: 0.9em;
    }
    .btn:hover {
        background-color: #004b99;
    }
    .btn-edit {
        background-color: #ffc107;
        color: black;
    }
    .btn-edit:hover {
        background-color: #e0a800;
    }
</style>
@endsection

@section('content')
<h3>Danh sách bài viết</h3>
<a href="{{ route('articles.create') }}" class="btn">Tạo bài viết mới</a>

@if($articles->isEmpty())
    <p style="margin-top: 20px;">Chưa có bài viết nào trong hệ thống.</p>
@else
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Ảnh minh họa</th>
                <th>Thẻ (Tags)</th>
                <th>Nội dung</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td><strong>{{ $article->title }}</strong></td>
                    <td>
                        @if(!empty($article->image_path))
                            <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh" style="max-width: 60px; max-height: 60px; border: 1px solid #ddd; padding: 2px; border-radius: 3px; display: block;">
                        @else
                            <span style="color: #999; font-size: 0.85em;">Không có</span>
                        @endif
                    </td>
                    <td>{{ $article->tags ?? 'Không có' }}</td>
                    <td>{{ Str::limit($article->body, 50) }}</td>
                    <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-edit">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
