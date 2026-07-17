@extends('layouts.app')

@section('title', 'Tạo sinh viên mới')

@section('content')
    <x-card title="Tạo sinh viên mới">
        <form method="POST" action="{{ url('/students') }}">
            @csrf

            <div style="margin-bottom:12px">
                <label for="name">Họ tên</label><br>
                <input type="text" id="name" name="name" value="{{ old('name') }}" style="width:100%;max-width:420px">
                @error('name')
                    <div style="color:#b91c1c; margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:12px">
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="{{ old('email') }}" style="width:100%;max-width:420px">
                @error('email')
                    <div style="color:#b91c1c; margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:12px">
                <label for="age">Tuổi</label><br>
                <input type="number" id="age" name="age" value="{{ old('age') }}" min="16" style="width:100%;max-width:180px">
                @error('age')
                    <div style="color:#b91c1c; margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:12px">
                <label for="gender">Giới tính</label><br>
                <select id="gender" name="gender" style="width:100%;max-width:180px">
                    <option value="">-- Chọn --</option>
                    <option value="male" @selected(old('gender') === 'male')>Nam</option>
                    <option value="female" @selected(old('gender') === 'female')>Nữ</option>
                </select>
                @error('gender')
                    <div style="color:#b91c1c; margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:12px">
                <label for="class_name">Lớp</label><br>
                <input type="text" id="class_name" name="class_name" value="{{ old('class_name') }}" style="width:100%;max-width:420px">
                @error('class_name')
                    <div style="color:#b91c1c; margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Lưu sinh viên</button>
        </form>
    </x-card>
@endsection
