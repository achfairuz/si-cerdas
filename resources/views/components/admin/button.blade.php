@props(['color' => 'green'])

@php
    $styles = [
        'green' => 'bg-green-600 hover:bg-green-700 text-white',
        'yellow' => 'bg-yellow-400 hover:bg-yellow-500 text-white',
        'red' => 'bg-red-500 hover:bg-red-600 text-white',
    ];
@endphp

<button
    {{ $attributes->merge([
        'class' => $styles[$color] . ' px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm',
    ]) }}>
    {{ $slot }}
</button>
