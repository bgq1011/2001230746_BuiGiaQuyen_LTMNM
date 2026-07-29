<div class="mb-4">
    <a href="{{ route('tin.index', ['keyword' => request('keyword')]) }}" 
       class="btn btn-sm {{ request('danh_muc_id') ? 'btn-outline-secondary' : 'btn-secondary' }} me-1">
        Tất cả
    </a>
    @foreach($dsDanhMuc as $dm)
        <a href="{{ route('tin.index', ['danh_muc_id' => $dm->id, 'keyword' => request('keyword')]) }}" 
           class="btn btn-sm {{ request('danh_muc_id') == $dm->id ? 'btn-secondary' : 'btn-outline-secondary' }} me-1">
            {{ $dm->ten }}
        </a>
    @endforeach
</div>
