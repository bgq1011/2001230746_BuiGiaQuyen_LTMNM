@extends('layouts.app')

@section('title', 'Đăng ký tài khoản')

@section('content')
<div style="max-width: 400px; margin: 30px auto; border: 1px solid #ccc; padding: 20px; border-radius: 4px; background-color: #fafafa;">
    <h3 style="margin-top: 0; margin-bottom: 15px; text-align: center;">Đăng ký</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Họ và tên -->
        <div class="form-group">
            <label for="name">Họ và tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Địa chỉ email -->
        <div class="form-group" style="margin-top: 15px;">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mật khẩu -->
        <div class="form-group" style="margin-top: 15px;">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
            @error('password')
                <div style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Xác nhận mật khẩu -->
        <div class="form-group" style="margin-top: 15px;">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
            @error('password_confirmation')
                <div style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-top: 15px; text-align: right;">
            <a href="{{ route('login') }}" style="font-size: 0.85em; color: #0066cc; text-decoration: none;">Đã có tài khoản? Đăng nhập</a>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 8px;">Đăng ký</button>
        </div>
    </form>
</div>
@endsection
