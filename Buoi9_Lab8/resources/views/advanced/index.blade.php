@extends('layouts.app')

@section('title', 'Bài tập 08: Nâng cao')

@section('content')
<h2>Bài tập 08: Eloquent Query Builder</h2>

<h3>1. Sản phẩm có giá > 100,000 đ</h3>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Danh mục</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expensiveProducts as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price) }} đ</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>2. Số lượng sản phẩm trong từng danh mục</h3>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Danh mục</th>
            <th>Số lượng sản phẩm</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->products_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3>3. Danh sách sinh viên kèm số lượng môn học đã đăng ký</h3>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số môn học đã đăng ký</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->courses_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
