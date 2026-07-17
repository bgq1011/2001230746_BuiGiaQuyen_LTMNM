{{-- Bài 06: anonymous component hiển thị nhãn độ tuổi --}}
@php
$age = (int)($age ?? 0);
$isAdult = $age >= 18;
@endphp

<span style="padding:2px 8px; border-radius:10px; font-size:12px;
            background:{{ $isAdult ? '#DCFCE7' : '#FEE2E2' }};
            color:{{ $isAdult ? '#166534' : '#7F1D1D' }};">

    {{ $isAdult ? 'Adult (≥18)' : 'Under 18' }}
</span>