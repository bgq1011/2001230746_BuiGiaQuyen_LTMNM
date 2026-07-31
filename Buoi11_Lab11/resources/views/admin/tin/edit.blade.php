@extends('admin.layouts.main')
@section('title','Sửa bài viết')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tổng quan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.tin.index') }}">Tin tức</a></li>
<li class="breadcrumb-item active">Sửa tin tức</li>
@endsection
@section('content')
<h1 class="h4 mb-3">Sửa bài viết #{{ $tin->id }}</h1>

<form class="card card-body" method="post" action="{{ route('admin.tin.update', $tin->id) }}" enctype="multipart/form-data">
    @csrf @method('put')
    <div class="row g-3">
        <div class="col-lg-8">
            <label class="form-label">Tiêu đề</label>
            <input name="tieude" value="{{ old('tieude',$tin->tieude) }}" class="form-control" required>
            @error('tieude')<div class="text-danger small">{{ $message }}</div>@enderror
            
            <label class="form-label mt-3">Slug</label>
            <input name="slug" value="{{ old('slug',$tin->slug) }}" class="form-control" placeholder="để trống sẽ tự sinh từ tiêu đề">
            @error('slug')<div class="text-danger small">{{ $message }}</div>@enderror
            
            <label class="form-label mt-3">Tóm tắt</label>
            <textarea name="tomtat" rows="2" class="form-control">{{ old('tomtat',$tin->tomtat) }}</textarea>
            
            <label class="form-label mt-3">Nội dung</label>
            <textarea name="noidung" rows="8" class="form-control" required>{{ old('noidung',$tin->noidung) }}</textarea>
            @error('noidung')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="col-lg-4">
            <label class="form-label">Danh mục</label>
            <select name="danhmuc_id" class="form-select">
                <option value="">-- Không chọn --</option>
                @foreach($dm as $c)
                    <option value="{{ $c->id }}" @selected(old('danhmuc_id',$tin->danhmuc_id)==$c->id)>{{ $c->ten }}</option>
                @endforeach
            </select>
            <label class="form-label mt-3">Trạng thái</label>
            <select name="trang_thai" class="form-select">
                <option value="draft" @selected(old('trang_thai', $tin->trang_thai ?? 'draft') == 'draft')>Nháp</option>
                <option value="published" @selected(old('trang_thai', $tin->trang_thai ?? 'draft') == 'published')>Đã đăng</option>
            </select>
            <label class="form-label mt-3">Ngày đăng</label>
            <input type="date" name="ngaydang" value="{{ old('ngaydang', optional($tin->ngaydang)->toDateString()) }}" class="form-control">
            <label class="form-label mt-3">Ảnh đại diện</label>
            <input type="file" name="hinhanh_up" class="form-control">
            <div class="mt-2">
                <img src="{{ $tin->thumb_url }}" class="rounded" style="width:180px;height:120px;object-fit:cover">
            </div>
            @error('hinhanh_up')<div class="text-danger small">{{ $message }}</div>@enderror

            <label class="form-label mt-3">Thêm ảnh phụ (Gallery)</label>
            <input type="file" name="gallery[]" multiple class="form-control">
            <div class="form-text">Có thể chọn nhiều ảnh phụ cùng lúc</div>

            @if($tin->hinhAnhs && $tin->hinhAnhs->count() > 0)
                <label class="form-label mt-3">Bộ sưu tập ảnh phụ</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($tin->hinhAnhs as $img)
                        <div class="position-relative border p-1 rounded bg-white" style="width: 100px;">
                            <img src="{{ asset('storage/' . $img->duongdan) }}" class="rounded w-100" style="height: 70px; object-fit: cover;">
                            <form action="{{ route('admin.tin.delete-image', $img->id) }}" method="POST" class="mt-1" onsubmit="return confirm('Xóa ảnh phụ này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-0" style="font-size: 11px;">Xóa ảnh</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Cập nhật</button>
        <a class="btn btn-secondary" href="{{ route('admin.tin.index') }}">Quay lại</a>
    </div>
</form>
@endsection
