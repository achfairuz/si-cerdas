@props(['type'])

@php
    $colors = [
        'education' => 'bg-blue-100 text-blue-700',
        'recipe' => 'bg-orange-100 text-orange-700',
    ];
@endphp

<span class="px-3 py-1 text-xs font-medium rounded-full {{ $colors[$type] ?? 'bg-gray-100 text-gray-600' }}">
    {{ ucfirst($type) }}
</span>
