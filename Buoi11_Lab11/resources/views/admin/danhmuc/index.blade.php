@extends('admin.layouts.main')
@section('title','Danh mục')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tổng quan</a></li>
<li class="breadcrumb-item active">Danh mục</li>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Danh mục</h1>
    <a class="btn btn-primary" href="{{ route('admin.danhmuc.create') }}">Thêm danh mục</a>
</div>
<form class="row row-cols-lg-auto g-2 align-items-center mb-3" method="get">
    <div class="col-12">
        <input name="kw" value="{{ $kw ?? '' }}" class="form-control" placeholder="Tìm theo tên/slug">
    </div>
    <div class="col-12">
        <button class="btn btn-outline-secondary">Tìm</button>
    </div>
</form>
<div class="card">
    <div class="table-responsive">
        <table class="table table-sm table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width:80px">ID</th>
                    <th>Tên</th>
                    <th>Slug</th>
                    <th style="width:160px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>{{ $r->ten }}</td>
                        <td class="text-muted">{{ $r->slug }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.danhmuc.edit',$r) }}">Sửa</a>
                            <form class="d-inline" method="post" action="{{ route('admin.danhmuc.destroy',$r) }}" onsubmit="return confirm('Xóa danh mục?')">
                                @csrf @method('delete')
                                <button class="btn btn-sm btn-outline-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">Không có dữ liệu</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $rows->links() }}
    </div>
</div>
@endsection