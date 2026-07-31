@hasSection('breadcrumb')
<nav aria-label="breadcrumb" class="mb-3">
<ol class="breadcrumb mb-0">
<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Admin</a></li>
@yield('breadcrumb')
</ol>
</nav>
@endif
