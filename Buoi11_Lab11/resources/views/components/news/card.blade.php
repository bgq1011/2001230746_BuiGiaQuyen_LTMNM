@props(['tin'])
<div class="card h-100 shadow-sm">
    <img src="{{ asset('images/news/' . ($tin->hinhanh ?? 'no-image.jpg')) }}"
         class="card-img-top object-cover"
         alt="{{ $tin->tieude }}"
         onerror="this.onerror=null; this.src='{{ asset('images/news/no-image.jpg') }}'">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title mb-2">
            <a href="{{ route('tin.show', $tin->slug ?: $tin->id) }}" class="stretched-link text-decoration-none">
                {{ $tin->tieude }}
            </a>
        </h5>
        @if($tin->tomtat)
            <p class="card-text text-muted mb-3">
                {{ \Illuminate\Support\Str::limit($tin->tomtat, 120) }}
            </p>
        @endif
        <div class="mt-auto">
            <span class="badge bg-secondary">
                {{ \Illuminate\Support\Carbon::parse($tin->ngaydang)->format('d/m/Y') }}
            </span>
        </div>
    </div>
</div>
