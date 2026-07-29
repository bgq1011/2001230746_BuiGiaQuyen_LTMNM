<div class="row align-items-center mb-4">
    <div class="col-md-6">
        <h1 class="h3 mb-md-0">Danh sách tin tức</h1>
    </div>
    <div class="col-md-6">
        <form action="{{ route('tin.index') }}" method="GET" class="d-flex">
            @if(request('danh_muc_id'))
                <input type="hidden" name="danh_muc_id" value="{{ request('danh_muc_id') }}">
            @endif
            <input type="text" 
                   name="keyword" 
                   class="form-control me-2" 
                   placeholder="Tìm kiếm theo tiêu đề..." 
                   value="{{ request('keyword') }}">
            <button type="submit" class="btn btn-outline-secondary">Tìm</button>
            @if(request('keyword'))
                <a href="{{ route('tin.index', ['danh_muc_id' => request('danh_muc_id')]) }}" class="btn btn-link text-decoration-none text-muted">Xóa</a>
            @endif
        </form>
    </div>
</div>
