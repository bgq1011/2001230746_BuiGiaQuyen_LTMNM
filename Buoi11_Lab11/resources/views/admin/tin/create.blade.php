@extends('admin.layouts.main')
@section('title','Thêm bài viết')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tổng quan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.tin.index') }}">Tin tức</a></li>
<li class="breadcrumb-item active">Chi tiết tin tức</li>
@endsection
@section('content')
<h1 class="h4 mb-3">Thêm bài viết</h1>
<form class="card card-body" method="post" action="{{ route('admin.tin.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-lg-8">
            <label class="form-label">Tiêu đề</label>
            <input name="tieude" value="{{ old('tieude') }}" class="form-control" required>
            @error('tieude')<div class="text-danger small">{{ $message }}</div>@enderror
            
            <label class="form-label mt-3">Slug</label>
            <input name="slug" value="{{ old('slug') }}" class="form-control" placeholder="để trống sẽ tự sinh từ tiêu đề">
            @error('slug')<div class="text-danger small">{{ $message }}</div>@enderror
            
            <label class="form-label mt-3">Tóm tắt</label>
            <textarea name="tomtat" rows="2" class="form-control">{{ old('tomtat') }}</textarea>
            @error('tomtat')<div class="text-danger small">{{ $message }}</div>@enderror
            
            <label class="form-label mt-3">Nội dung</label>
            <textarea name="noidung" rows="8" class="form-control" required>{{ old('noidung') }}</textarea>
            @error('noidung')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="col-lg-4">
            <label class="form-label">Danh mục</label>
            <select name="danhmuc_id" class="form-select">
                <option value="">-- Không chọn --</option>
                @foreach($dm as $c)
                    <option value="{{ $c->id }}" @selected(old('danhmuc_id')==$c->id)>{{ $c->ten }}</option>
                @endforeach
            </select>
            <label class="form-label mt-3">Trạng thái</label>
            <select name="trang_thai" class="form-select">
                <option value="draft" @selected(old('trang_thai', 'draft') == 'draft')>Nháp</option>
                <option value="published" @selected(old('trang_thai') == 'published')>Đã đăng</option>
            </select>
            <label class="form-label mt-3">Ngày đăng</label>
            <input type="date" name="ngaydang" value="{{ old('ngaydang', now()->toDateString()) }}" class="form-control">
            <label class="form-label mt-3">Ảnh đại diện</label>
            <input type="file" name="hinhanh_up" class="form-control">
            <div class="form-text">jpg, jpeg, png, webp ≤ 2MB</div>
            @error('hinhanh_up')<div class="text-danger small">{{ $message }}</div>@enderror

            <label class="form-label mt-3">Ảnh phụ (Gallery)</label>
            <input type="file" name="gallery[]" multiple class="form-control">
            <div class="form-text">Có thể chọn nhiều ảnh phụ cùng lúc</div>
        </div>
    </div>
    <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Lưu</button>
        <a class="btn btn-secondary" href="{{ route('admin.tin.index') }}">Hủy</a>
    </div>
</form>
@endsection
