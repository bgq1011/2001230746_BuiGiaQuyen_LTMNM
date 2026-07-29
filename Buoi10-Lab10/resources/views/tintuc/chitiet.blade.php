@extends('layout')

@section('title', $tin->tieude)

@section('content')
<article class="row">
    <div class="col-lg-10 mx-auto">
        <header class="mb-3">
            <h1 class="h2">{{ $tin->tieude }}</h1>
            <div class="text-muted small">
                Ngày đăng: {{ \Illuminate\Support\Carbon::parse($tin->ngaydang)->format('d/m/Y') }}
            </div>
        </header>

        @if($tin->hinhanh)
            <img src="{{ asset('images/news/' . $tin->hinhanh) }}" class="img-fluid rounded mb-3" alt="{{ $tin->tieude }}">
        @endif

        <div class="fs-5 lh-lg">
            {!! nl2br(e($tin->noidung)) !!}
        </div>

        <hr class="my-4">

        <a href="{{ route('tin.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
    </div>
</article>
@endsection
