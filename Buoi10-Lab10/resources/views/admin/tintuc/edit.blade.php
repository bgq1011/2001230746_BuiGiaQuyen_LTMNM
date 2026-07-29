@extends('layout')

@section('title', 'Chỉnh sửa bài viết')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">Chỉnh sửa bài viết #{{ $tin->id }}</h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Chức năng cập nhật bài viết (Giao diện mẫu)');">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" value="{{ $tin->tieude }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select class="form-select">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($dsDanhMuc as $dm)
                                <option value="{{ $dm->id }}" {{ $tin->danh_muc_id == $dm->id ? 'selected' : '' }}>
                                    {{ $dm->ten }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tóm tắt</label>
                        <textarea class="form-control" rows="3">{{ $tin->tomtat }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea class="form-control" rows="6" required>{{ $tin->noidung }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên file hình ảnh</label>
                        <input type="text" class="form-control" value="{{ $tin->hinhanh }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.tintuc.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
