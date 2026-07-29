@extends('layout')

@section('title', 'Thêm bài viết mới')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">Thêm bài viết mới</h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Chức năng lưu bài viết (Giao diện mẫu)');">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" placeholder="Nhập tiêu đề bài viết" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select class="form-select">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($dsDanhMuc as $dm)
                                <option value="{{ $dm->id }}">{{ $dm->ten }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tóm tắt</label>
                        <textarea class="form-control" rows="3" placeholder="Nhập tóm tắt ngắn"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea class="form-control" rows="6" placeholder="Nhập nội dung bài viết" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên file hình ảnh</label>
                        <input type="text" class="form-control" placeholder="Ví dụ: 1.jpg">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tintuc.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-success">Lưu bài viết</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
