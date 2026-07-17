{{-- Bài 05: so sánh mảng tĩnh và dữ liệu CSDL trên cùng giao diện --}}
@extends('layouts.app')
@section('title','So sánh nguồn dữ liệu')
@section('content')
<h2>So sánh nguồn dữ liệu: Mảng tĩnh vs CSDL (Eloquent)</h2>
<nav style="margin-bottom:12px">
    <a href="{{ url('/students/combined?source=array') }}">Tab: Tĩnh
        (Array)</a> |

    <a href="{{ url('/students/combined?source=db') }}">Tab: CSDL
        (Eloquent)</a>
</nav>
@if($source === 'array')
<h3>Nguồn: Mảng tĩnh</h3>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Tuổi</th>
            <th>Giới
                tính</th>
            <th>Lớp</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($static as $s)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s['name'] }}</td>
            <td>{{ $s['age'] }}</td>
            <td>{{ $s['gender'] }}</td>
            <td>{{ $s['class_name'] }}</td>
            <td>{{ $s['email'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h3>Nguồn: CSDL (Eloquent) – có phân trang</h3>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Tuổi</th>
            <th>Giới
                tính</th>
            <th>Lớp</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($db as $s)
        <tr>
            <td>{{ $loop->iteration + ($db->currentPage()-1)*$db->perPage()
}}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->age }}</td>
            <td>{{ $s->gender }}</td>
            <td>{{ $s->class_name }}</td>
            <td>{{ $s->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top:12px">
    {{ $db->appends(['source'=>'db'])->links() }}
</div>
@endif
@endsection