{{-- Bài 03: hiển thị danh sách sinh viên từ mảng tĩnh --}}
@extends('layouts.app')
@section('title','Danh sách sinh viên (Mảng)')
@section('content')
<h2>Danh sách sinh viên – Nguồn: Mảng tĩnh</h2>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Tuổi</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $s)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s['name'] }}</td>
            <td>{{ $s['age'] }}</td>
            <td>{{ $s['email'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection