{{-- Bài 08: UI nâng cấp với x-button và CSS nhỏ bằng @push('styles') --}}
@extends('layouts.app')
@section('title','Sửa bài viết')
@section('content')
<h2>Sửa bài viết #{{ $article['id'] }}</h2>
<form action="{{ route('articles.update',$article['id']) }}" method="post" class="article-form">
    @csrf
    @method('PUT')
    <x-input name="title" label="Tiêu đề" :value="$article['title']" />
    <label class="form-label">Nội dung</label>
    <textarea name="body" rows="6" class="form-textarea">{{ old('body',$article['body'])}}</textarea>
    @error('body')
    <div class="form-error">{{ $message }}</div>
    @enderror
    <x-button type="submit" variant="primary">Cập nhật</x-button>
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