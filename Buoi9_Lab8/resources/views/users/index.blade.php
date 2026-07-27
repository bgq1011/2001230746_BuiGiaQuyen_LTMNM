@extends('layouts.app')

@section('title', 'Bài 05: User - Profile')

@section('content')
<h2>Bài tập 05: Quan hệ One to One (User - Profile)</h2>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $index => $user)
            <tr>
                <td>{{ $users->firstItem() + $index }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->profile->phone ?? 'N/A' }}</td>
                <td>{{ $user->profile->address ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 15px;">
    {{ $users->links() }}
</div>
@endsection