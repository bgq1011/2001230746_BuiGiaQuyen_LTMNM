<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Quản lý')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #0066cc;
        }
        nav a.active {
            font-weight: bold;
            color: #000;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .alert {
            padding: 10px;
            background-color: #e2f0d9;
            border: 1px solid #b6d7a8;
            margin-bottom: 15px;
        }
        .btn {
            padding: 4px 8px;
            text-decoration: none;
            color: #000;
            border: 1px solid #ccc;
            background: #f0f0f0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Bài 05: User - Profile</a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Bài 06 & 07: Products CRUD</a>
        <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">Sinh viên</a>
        <a href="{{ route('advanced.index') }}" class="{{ request()->routeIs('advanced.*') ? 'active' : '' }}">Bài 08: Nâng cao</a>
    </nav>
    <hr>
    <main>
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>