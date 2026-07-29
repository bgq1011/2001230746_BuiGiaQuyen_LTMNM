@extends('layout')

@section('title', 'Quản lý bài viết')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Quản lý bài viết</h1>
    <a href="{{ route('admin.tintuc.create') }}" class="btn btn-primary btn-sm">
        + Thêm bài viết mới
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 50px;">ID</th>
                <th style="width: 80px;">Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th style="width: 120px;">Ngày đăng</th>
                <th style="width: 140px;" class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dsTin as $tin)
                <tr>
                    <td>{{ $tin->id }}</td>
                    <td>
                        <img src="{{ asset('images/news/' . ($tin->hinhanh ?? 'no-image.jpg')) }}" 
                             alt="{{ $tin->tieude }}" 
                             class="img-thumbnail" 
                             style="width: 60px; height: 40px; object-fit: cover;"
                             onerror="this.onerror=null; this.src='{{ asset('images/news/no-image.jpg') }}'">
                    </td>
                    <td class="fw-semibold">{{ $tin->tieude }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $tin->danhMuc->ten ?? 'Chưa phân loại' }}
                        </span>
                    </td>
                    <td>{{ \Illuminate\Support\Carbon::parse($tin->ngaydang)->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.tintuc.edit', $tin->id) }}" class="btn btn-sm btn-warning me-1">Sửa</a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="alert('Chức năng xóa (Giao diện mẩu)')">Xóa</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Chưa có bài viết nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $dsTin->links() }}
</div>
@endsection
