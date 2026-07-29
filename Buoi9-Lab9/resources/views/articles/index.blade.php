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
        border: 1px solid #333;
        padding: 8px 12px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
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
                            <img src="{{ asset('storage/' . $article->image_path) }}" alt="Ảnh" style="max-width: 120px; max-height: 120px; border: 1px solid #ddd; padding: 2px; border-radius: 3px; display: block;">
                        @else
                            <span style="color: #999; font-size: 0.85em;">Không có</span>
                        @endif
                    </td>
                    <td>{{ $article->tags ?? 'Không có' }}</td>
                    <td>{{ Str::limit($article->body, 50) }}</td>
                    <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if(auth()->check() && $article->user_id === auth()->id())
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-edit">Sửa</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background-color: #dc3545; color: white; border: none; cursor: pointer;">Xóa</button>
                            </form>
                        @else
                            <span style="color: #999; font-size: 0.85em;">Không có quyền</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
