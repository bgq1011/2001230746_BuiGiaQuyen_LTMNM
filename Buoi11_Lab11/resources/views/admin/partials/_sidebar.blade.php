<h5 class="mb-3">Lab News - Admin</h5>
<nav class="nav nav-pills flex-column gap-1">
<a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-white-50' }}" href="{{ route('admin.dashboard') }}">
<i class="bi bi-speedometer2 me-2"></i> Tổng quan
</a>
<a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.danhmuc.*') ? 'active' : 'text-white-50' }}" href="{{ route('admin.danhmuc.index') }}">
<i class="bi bi-folder2-open me-2"></i> Danh mục
</a>
<a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.tin.*') || request()->routeIs('admin.tintuc.*') ? 'active' : 'text-white-50' }}" href="{{ route('admin.tin.index') }}">
<i class="bi bi-newspaper me-2"></i> Tin tức
</a>
@auth
<form method="POST" action="{{ route('logout') }}" class="mt-3">
@csrf
<button class="btn btn-warning w-100"><i class="bi bi-box-arrow-right me-1"></i> Đăng xuất</button>
</form>
@endauth
</nav>
