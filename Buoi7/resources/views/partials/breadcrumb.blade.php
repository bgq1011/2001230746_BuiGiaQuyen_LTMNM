{{-- Bài 09: Breadcrumb theo route hiện tại --}}
@php($routeName = optional(request()->route())->getName())

<nav aria-label="breadcrumb" style="margin-bottom: 12px; font-size: 0.95rem;">
    <a href="{{ url('/') }}" style="color:#2563eb; text-decoration:none;">Trang chủ</a>

    @if($routeName === 'articles.index')
        <span> / Articles</span>
        <span style="margin-left:8px;">
            <a href="{{ route('articles.create') }}" style="color:#2563eb; text-decoration:none;">Tạo mới</a>
        </span>
    @elseif($routeName === 'articles.create')
        <span> / </span>
        <a href="{{ route('articles.index') }}" style="color:#2563eb; text-decoration:none;">Articles</a>
        <span> / Tạo bài viết</span>
    @elseif($routeName === 'articles.edit')
        <span> / </span>
        <a href="{{ route('articles.index') }}" style="color:#2563eb; text-decoration:none;">Articles</a>
        <span> / Sửa bài viết</span>
    @elseif($routeName === 'articles.show')
        <span> / </span>
        <a href="{{ route('articles.index') }}" style="color:#2563eb; text-decoration:none;">Articles</a>
        <span> / Chi tiết bài viết</span>
    @else
        <span> / Articles</span>
    @endif
</nav>
