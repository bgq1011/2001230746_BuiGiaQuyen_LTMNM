<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý Bài Viết')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #ffffff;
            color: #333333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        header {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            font-size: 1.5em;
            margin: 0;
        }
        .nav-links {
            display: flex;
            align-items: center;
        }
        .nav-links a {
            margin-left: 15px;
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .alert-success {
            background-color: #e2f0d9;
            border: 1px solid #b6d7a8;
            color: #385723;
            padding: 10px;
            margin-bottom: 20px;
        }
        .btn {
            padding: 5px 10px;
            border: 1px solid #999;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            cursor: pointer;
            font-size: 0.9em;
            border-radius: 3px;
        }
        .btn:hover {
            background-color: #e0e0e0;
        }
        .btn-danger {
            color: #cc0000;
        }
        
        /* Simple plain chat styles */
        .chat-box {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 15px;
            background-color: #fafafa;
            margin-top: 15px;
        }
        .chat-bubble {
            margin-bottom: 15px;
            padding: 8px 12px;
            border-radius: 4px;
            max-width: 80%;
            word-wrap: break-word;
        }
        .bubble-bot {
            background-color: #ffffff;
            border: 1px solid #ccc;
            margin-right: auto;
        }
        .bubble-user {
            background-color: #e8e8e8;
            border: 1px solid #ddd;
            margin-left: auto;
            text-align: right;
        }
        .bubble-time {
            font-size: 0.8em;
            color: #666;
            margin-top: 4px;
            display: block;
        }
        
        /* Plain article list */
        .article-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .article-details {
            flex: 1;
        }
        .article-title {
            font-weight: bold;
            font-size: 1.1em;
            color: #333;
        }
        
        /* Form styles */
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Quản lý Bài viết</h1>
            <div class="nav-links">
                <a href="{{ route('articles.index') }}">Danh sách bài viết</a>
                
                @auth
                    <!-- Chỉ hiển thị cho người dùng đã đăng nhập -->
                    <a href="{{ route('articles.create') }}">Tạo bài mới</a>
                    <span style="margin-left: 15px; font-size: 0.9em; color: #555;">(Chào, {{ Auth::user()->name }})</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 10px;">
                        @csrf
                        <button type="submit" class="btn" style="padding: 2px 8px; font-size: 0.85em;">Đăng xuất</button>
                    </form>
                @endauth
                
                @guest
                    <!-- Chỉ hiển thị cho khách chưa đăng nhập -->
                    <a href="{{ route('login') }}">Đăng nhập</a>
                    <a href="{{ route('register') }}">Đăng ký</a>
                @endguest
            </div>
        </header>

        <main>
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
