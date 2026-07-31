@extends('admin.layouts.main')
@section('title','Sửa bài viết')
@section('content')
<h1 class="h4 mb-3">Sửa bài viết #{{ $tin->id }}</h1>

<form class="card card-body" method="post" action="{{ route('admin.tin.update', $tin->id) }}" enctype="multipart/form-data">
    @csrf @method('put')
    <div class="row g-3">
        <div class="col-lg-8">
            <label class="form-label">Tiêu đề</label>
            <input name="tieude" value="{{ old('tieude',$tin->tieude) }}" class="form-control" required>
            @error('tieude')<div class="text-danger small">{{ $message }}</div>@enderror
            
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
                @foreach($dm ?? $dsDanhMuc ?? [] as $c)
                    <option value="{{ $c->id }}" @selected(old('danhmuc_id',$tin->danhmuc_id ?? $tin->danh_muc_id)==$c->id)>{{ $c->ten }}</option>
                @endforeach
            </select>
            <label class="form-label mt-3">Ngày đăng</label>
            <input type="date" name="ngaydang" value="{{ old('ngaydang', optional($tin->ngaydang)->toDateString()) }}" class="form-control">
            <label class="form-label mt-3">Ảnh đại diện</label>
            <input type="file" name="hinhanh_up" class="form-control">
            <div class="mt-2">
                <img src="{{ $tin->thumb_url }}" class="rounded" style="width:180px;height:120px;object-fit:cover">
            </div>
            @error('hinhanh_up')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="mt-3 d-flex gap-2">
        <button class="btn btn-primary">Cập nhật</button>
        <a class="btn btn-secondary" href="{{ route('admin.tin.index') }}">Quay lại</a>
    </div>
</form>
@endsection
