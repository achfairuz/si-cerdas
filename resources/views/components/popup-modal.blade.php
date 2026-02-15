@props([
    'name',
    'title' => 'Konfirmasi',
    'message' => 'Apakah Anda yakin?',
    'confirmText' => 'Ya',
    'cancelText' => 'Batal',
    'confirmClass' => 'bg-red-600 hover:bg-red-700',
])

<div x-data="{
    show: false,
    modalName: '{{ $name }}'
}" x-on: open-modal.window="if ($event.detail === modalName) show = true" x-on:
    close-modal.window="if ($event.detail === modalName) show = false" x-cloak>

    <!-- Overlay -->
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-black/50 z-50" @click="show = false"></div>

    <!-- Modal -->
    <div x-show="show" x-transition.scale class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6">

            <h2 class="text-xl font-bold text-gray-800 mb-3">
                {{ $title }}
            </h2>

            <p class="text-gray-600 mb-6">
                {{ $message }}
            </p>

            <div class="flex justify-end gap-3">

                <button @click="show = false" class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-700">
                    {{ $cancelText }}
                </button>

                <button {{ $attributes }} class="px-4 py-2 rounded-xl text-white {{ $confirmClass }}">
                    {{ $confirmText }}
                </button>

            </div>

        </div>
    </div>
</div>
