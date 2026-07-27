@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div style="max-width: 400px; margin: 30px auto; border: 1px solid #ccc; padding: 20px; border-radius: 4px; background-color: #fafafa;">
    <h3 style="margin-top: 0; margin-bottom: 15px; text-align: center;">Đăng nhập</h3>
    
    @if(session('status'))
        <div style="color: green; margin-bottom: 15px; font-size: 0.9em;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="margin-top: 15px;">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
            @error('password')
                <div style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between;">
            <label style="font-weight: normal; font-size: 0.9em; display: inline-flex; align-items: center; cursor: pointer;">
                <input type="checkbox" name="remember" id="remember_me" style="margin-right: 5px;">
                Duy trì đăng nhập
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size: 0.85em; color: #0066cc; text-decoration: none;">Quên mật khẩu?</a>
            @endif
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 8px;">Đăng nhập</button>
        </div>
    </form>
</div>
@endsection
