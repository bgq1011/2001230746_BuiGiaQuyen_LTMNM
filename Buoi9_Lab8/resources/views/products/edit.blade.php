@extends('layouts.app')

@section('title', 'Sửa sản phẩm')

@section('content')
<h2>Chỉnh sửa sản phẩm</h2>

<form action="{{ route('products.update', $product) }}" method="POST" style="max-width: 400px;">
    @csrf
    @method('PUT')

    <x-input name="name" label="Tên sản phẩm" :value="$product->name" required />

    <x-input name="price" label="Giá sản phẩm" type="number" :value="$product->price" required />

    <x-input name="stock" label="Số lượng tồn kho" type="number" :value="$product->stock" required />

    <div style="margin-bottom: 10px;">
        <label for="category_id" style="display: block; margin-bottom: 3px;">Danh mục sản phẩm</label>
        <select name="category_id" id="category_id" style="width: 100%; padding: 6px;">
            <option value="">-- Chọn danh mục --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('category_id'))
            <div style="color: red; font-size: 13px;">{{ $errors->first('category_id') }}</div>
        @endif
    </div>

    <p>
        <button type="submit" class="btn">Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn">Hủy</a>
    </p>
</form>
@endsection
