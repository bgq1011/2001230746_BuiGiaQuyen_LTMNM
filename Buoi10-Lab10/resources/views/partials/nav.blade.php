<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="{{ route('tin.index') }}">Lab10 News</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('tin.index') }}">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-warning" href="{{ route('admin.tintuc.index') }}">Quản trị Admin</a></li>
            </ul>
        </div>
    </div>
</nav>
