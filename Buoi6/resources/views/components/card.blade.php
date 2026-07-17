@props(['title' => null])

<div style="border:1px solid #d1d5db; border-radius:12px; padding:20px; background:#fff; box-shadow:0 6px 18px rgba(0,0,0,0.04); margin-bottom:16px;">
    @if ($title)
        <h3 style="margin-top:0; margin-bottom:12px; font-size:1.1rem;">{{ $title }}</h3>
    @endif

    <div>
        {{ $slot }}
    </div>
</div>
