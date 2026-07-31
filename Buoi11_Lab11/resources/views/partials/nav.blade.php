<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="{{ route('tin.index') }}">Lab10 News</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('tin.index') }}">Trang chủ</a></li>
                @auth
                    <li class="nav-item text-white me-2">
                        <span class="text-white-50">Xin chào,</span> <strong>{{ auth()->user()->name }}</strong>
                    </li>
                    @if((auth()->user()->role ?? (auth()->user()->email === 'admin@example.com' ? 'admin' : 'user')) === 'admin')
                        <li class="nav-item"><a class="nav-link text-warning fw-semibold" href="{{ route('admin.home') }}">Quản trị Admin</a></li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Đăng xuất</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a class="btn btn-outline-light btn-sm" href="{{ route('register') }}">Đăng ký</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
