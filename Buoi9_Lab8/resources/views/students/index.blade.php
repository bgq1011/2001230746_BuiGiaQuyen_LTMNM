@extends('layouts.app')

@section('title', 'Danh sách Sinh viên')

@section('content')
<h2>Danh sách sinh viên và môn học đã đăng ký</h2>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Môn học đăng ký</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->email }}</td>
                <td>
                    @if($s->courses->count() > 0)
                        {{ $s->courses->pluck('title')->join(', ') }}
                    @else
                        Chưa đăng ký
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection