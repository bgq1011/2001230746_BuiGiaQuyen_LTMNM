@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
<h2>Danh sách sản phẩm (Bài 06 & 07)</h2>

<p>
    <a href="{{ route('products.create') }}" class="btn">+ Thêm sản phẩm mới</a>
</p>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Tồn kho</th>
            <th>Danh mục</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $index => $product)
            <tr>
                <td>{{ $products->firstItem() + $index }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price) }} đ</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn">Sửa</a>
                    
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('Xóa sản phẩm này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 15px;">
    {{ $products->links() }}
</div>
@endsection