@extends('layouts.app')

@section('title', 'Quên mật khẩu')

@section('content')
<div style="max-width: 400px; margin: 30px auto; border: 1px solid #ccc; padding: 20px; border-radius: 4px; background-color: #fafafa;">
    <h3 style="margin-top: 0; margin-bottom: 15px; text-align: center;">Quên mật khẩu</h3>
    
    <div style="font-size: 0.9em; color: #666; margin-bottom: 15px; line-height: 1.4;">
        Nhập địa chỉ email của bạn, chúng tôi sẽ gửi liên kết để bạn đặt lại mật khẩu mới.
    </div>

    @if(session('status'))
        <div style="color: green; margin-bottom: 15px; font-size: 0.9em;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div style="color: red; font-size: 0.85em; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('login') }}" style="font-size: 0.85em; color: #0066cc; text-decoration: none;">Quay lại đăng nhập</a>
            <button type="submit" class="btn btn-primary" style="padding: 8px 15px;">Gửi liên kết</button>
        </div>
    </form>
</div>
@endsection
