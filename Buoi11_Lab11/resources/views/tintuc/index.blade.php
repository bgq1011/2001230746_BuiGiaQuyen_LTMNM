@extends('layout')

@section('title', 'Danh sách tin tức')

@section('content')
    {{-- Thanh tìm kiếm --}}
    @include('partials.search')

    {{-- Bộ lọc danh mục --}}
    @include('partials.categories')

    {{-- Danh sách bài viết --}}
    @if($dsTin->isEmpty())
        <div class="alert alert-info">Không tìm thấy bài viết nào phù hợp.</div>
    @else
        <div class="row g-4">
            @foreach($dsTin as $tin)
                <div class="col-md-6 col-lg-4">
                    <x-news.card :tin="$tin" />
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $dsTin->links() }}
        </div>
    @endif
@endsection
