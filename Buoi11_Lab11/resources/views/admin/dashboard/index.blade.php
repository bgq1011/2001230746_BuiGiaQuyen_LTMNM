@extends('admin.layouts.main')
@section('title','Tổng quan')
@section('breadcrumb')
<li class="breadcrumb-item active">Tổng quan</li>
@endsection
@section('content')
<div class="row g-3">
<div class="col-md-4">
<div class="card shadow-sm">
<div class="card-body d-flex align-items-center">
<i class="bi bi-newspaper display-6 me-3"></i>
<div>
<div class="small text-muted">Tổng số bài viết</div>
<div class="h4 mb-0">{{ $totalPost }}</div>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card shadow-sm">
<div class="card-body d-flex align-items-center">
<i class="bi bi-trash3 display-6 me-3"></i>
<div>
<div class="small text-muted">Trong thùng rác</div>
<div class="h4 mb-0">{{ $trashPost }}</div>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card shadow-sm">
<div class="card-body d-flex align-items-center">
<i class="bi bi-folder2-open display-6 me-3"></i>
<div>
<div class="small text-muted">Số danh mục</div>
<div class="h4 mb-0">{{ $totalCat }}</div>
</div>
</div>
</div>
</div>
</div>
@endsection
