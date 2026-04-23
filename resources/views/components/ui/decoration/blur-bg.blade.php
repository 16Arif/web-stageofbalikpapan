@props(['position' => 'top', 'color' => 'from-[#0ea5e9] to-[#4f46e5]'])

@php
    $positionClasses = [
        'top' => '-top-40 left-[calc(50%-11rem)] sm:-top-80 sm:left-[calc(50%-30rem)]',
        'bottom' => 'top-[calc(100%-13rem)] left-[calc(50%+3rem)] sm:top-[calc(100%-30rem)] sm:left-[calc(50%+36rem)]',
        'center' => 'top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2',
    ];
@endphp

<div aria-hidden="true"
    class="absolute inset-x-0 -z-10 transform-gpu overflow-hidden blur-3xl pointer-events-none {{ $position === 'bottom' ? 'top-[calc(100%-13rem)]' : '' }}">
    <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
        class="relative aspect-1155/678 w-[72rem] -translate-x-1/2 bg-linear-to-tr {{ $color }} opacity-20 {{ $positionClasses[$position] ?? $positionClasses['top'] }}">
    </div>
</div>
