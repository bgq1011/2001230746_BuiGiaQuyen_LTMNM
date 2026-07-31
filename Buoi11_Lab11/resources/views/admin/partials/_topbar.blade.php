<div class="bg-white border-bottom py-2 px-3 d-flex justify-content-between align-items-center">
<div class="fw-semibold"><i class="bi bi-gear-wide-connected me-1"></i> Khu vực quản trị</div>
<div class="small text-muted">
@auth 
    <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
    <span class="badge bg-primary ms-1">{{ strtoupper(auth()->user()->role ?? 'ADMIN') }}</span>
@endauth
</div>
</div>
