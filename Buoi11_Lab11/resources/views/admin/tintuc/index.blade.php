@extends('admin.layouts.main')
@section('title','Tin tức')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tổng quan</a></li>
<li class="breadcrumb-item active">Tin tức</li>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Danh sách bài viết</h1>
    <div class="d-flex gap-2">
        <a class="btn btn-outline-secondary" href="{{ route('admin.tin.index', array_merge(request()->query(), ['trash' => request('trash') ? 0 : 1])) }}">
            {{ request('trash') ? 'Xem tất cả' : 'Xem thùng rác' }}
        </a>
        <a class="btn btn-primary" href="{{ route('admin.tin.create') }}">Thêm bài viết</a>
    </div>
</div>
<form class="row row-cols-lg-auto g-2 align-items-center mb-3" method="get">
    <div class="col-12">
        <input name="kw" value="{{ request('kw') }}" class="form-control" placeholder="Tìm theo tiêu đề">
    </div>
    <div class="col-12">
        <select name="trang_thai" class="form-select">
            <option value="">-- Tất cả trạng thái --</option>
            <option value="published" @selected(request('trang_thai') == 'published')>Đã đăng</option>
            <option value="draft" @selected(request('trang_thai') == 'draft')>Nháp</option>
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-outline-secondary">Tìm</button>
    </div>
</form>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:80px">ID</th>
                    <th style="width:100px">Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th style="width:110px">Trạng thái</th>
                    <th style="width:120px">Ngày đăng</th>
                    <th style="width:220px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $r)
                    <tr class="{{ $r->deleted_at ? 'opacity-50' : '' }}">
                        <td>{{ $r->id }}</td>
                        <td>
                            <img src="{{ $r->thumb_url }}" class="rounded" style="width:90px;height:60px;object-fit:cover">
                        </td>
                        <td class="fw-semibold">{{ $r->tieude }}</td>
                        <td class="text-muted">{{ $r->danhMuc->ten ?? '-' }}</td>
                        <td>
                            @if(($r->trang_thai ?? 'draft') === 'published')
                                <span class="badge bg-success">Đã đăng</span>
                            @else
                                <span class="badge bg-secondary">Nháp</span>
                            @endif
                        </td>
                        <td>{{ optional($r->ngaydang)->format('d/m/Y') }}</td>
                        <td>
                            @if(!$r->deleted_at)
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.tin.edit', $r->id) }}">Sửa</a>
                                <form class="d-inline" method="post" action="{{ route('admin.tin.destroy', $r->id) }}" onsubmit="return confirm('Xóa (đưa vào thùng rác)?')">
                                    @csrf @method('delete')
                                    <button class="btn btn-sm btn-outline-danger">Xóa</button>
                                </form>
                            @else
                                <form class="d-inline" method="post" action="{{ route('admin.tin.restore',$r->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Khôi phục</button>
                                </form>
                                <form class="d-inline" method="post" action="{{ route('admin.tin.force-delete',$r->id) }}" onsubmit="return confirm('Xóa vĩnh viễn?')">
                                    @csrf @method('delete')
                                    <button class="btn btn-sm btn-danger">Xóa vĩnh viễn</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">Không có dữ liệu</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $rows->links() }}</div>
</div>
@endsection
