@extends('admin.layouts.main')
@section('title','Sửa danh mục')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tổng quan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.danhmuc.index') }}">Danh mục</a></li>
<li class="breadcrumb-item active">Sửa danh mục</li>
@endsection
@section('content')
<h1 class="h4 mb-3">Sửa danh mục #{{ $danhmuc->id }}</h1>
<form method="post" action="{{ route('admin.danhmuc.update',$danhmuc) }}" class="card card-body">
    @csrf @method('put')
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input name="ten" value="{{ old('ten',$danhmuc->ten) }}" class="form-control" required>
        @error('ten')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input name="slug" value="{{ old('slug',$danhmuc->slug) }}" class="form-control" placeholder="để trống sẽ tự sinh từ tên">
        @error('slug')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-primary">Cập nhật</button>
        <a class="btn btn-secondary" href="{{ route('admin.danhmuc.index') }}">Quay lại</a>
    </div>
</form>
@endsection
