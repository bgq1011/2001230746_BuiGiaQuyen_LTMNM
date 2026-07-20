{{-- Bài 08: UI nâng cấp với x-button và CSS nhỏ bằng @push('styles') --}}
@extends('layouts.app')
@section('title','Tạo bài viết')
@section('content')
<h2>Tạo bài viết</h2>
<x-alert type="warning" title="Lưu ý">Dữ liệu hiện chỉ mô phỏng (chưa lưu DB).</x-alert>
<form action="{{ route('articles.store') }}" method="post" class="article-form">
    @csrf
    <x-input name="title" label="Tiêu đề" />
    <label class="form-label">Nội dung</label>
    <textarea name="body" rows="6" class="form-textarea">{{ old('body') }}</textarea>
    @error('body')
    <div class="form-error">{{ $message }}</div>
    @enderror
    <x-button type="submit" variant="primary">Lưu</x-button>
</form>
@push('styles')
<style>
    .article-form { max-width: 640px; }
    .form-label { display:block; margin:8px 0 4px; font-weight:600; }
    .form-textarea { width:100%; padding:8px; border:1px solid #e5e7eb; border-radius:6px; }
    .form-error { color:#991B1B; margin-top:4px; }
</style>
@endpush
@endsection