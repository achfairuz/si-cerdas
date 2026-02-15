<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-sm border border-gray-100']) }}>
    <div class="p-6">
        {{ $slot }}
    </div>
</div>
