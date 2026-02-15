@extends('layouts.admin')

@section('content')
    <div class="p-6 space-y-6" x-data="{ deleteModal: false, deleteId: null }">

        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Kelola Edukasi</h1>

            <a href="{{ route('educations.create') }}">
                <x-admin.button color="green">
                    + Tambah Edukasi
                </x-admin.button>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <x-admin.card>
            <x-admin.table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Link</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($educations as $index => $item)
                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $educations->firstItem() + $index }}
                            </td>

                            <td class="px-4 py-3">
                                @if ($item->imageUrl)
                                    <img src="{{ asset($item->imageUrl) }}"
                                        class="w-16 h-16 rounded-xl object-cover shadow">
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 font-semibold">
                                {{ $item->title }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-600 max-w-xs">
                                {!! \Illuminate\Support\Str::limit(strip_tags($item->description), 80) !!}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->category->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                @if ($item->link)
                                    @php
                                        $isYoutube =
                                            str_contains($item->link, 'youtube.com') ||
                                            str_contains($item->link, 'youtu.be');
                                    @endphp

                                    <a href="{{ $item->link }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-lg text-sm
                {{ $isYoutube ? 'bg-red-100 text-red-600 hover:bg-red-200' : 'bg-blue-100 text-blue-600 hover:bg-blue-200' }}
                transition">

                                        @if ($isYoutube)
                                            ▶ YouTube
                                        @else
                                            🔗 Link
                                        @endif

                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 space-x-2 text-center">
                                <a href="{{ route('educations.edit', $item->id) }}">
                                    <x-admin.button color="yellow">Edit</x-admin.button>
                                </a>

                                <x-admin.button color="red" type="button"
                                    @click="deleteModal = true; deleteId = {{ $item->id }}">
                                    Delete
                                </x-admin.button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-start py-10">
                                <div class="flex flex-col items-center space-y-3">
                                    <div class="text-gray-400 text-5xl">📚</div>
                                    <p class="text-gray-500 font-medium">Belum ada data edukasi</p>

                                    <a href="{{ route('educations.create') }}">
                                        <x-admin.button color="green">
                                            Tambah Edukasi
                                        </x-admin.button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($educations->hasPages())
                    <div class="mt-8 bg-white p-4 rounded-xl shadow-sm">
                        <div class="flex justify-between items-center">

                            <p class="text-sm text-gray-500">
                                Menampilkan
                                <span class="font-semibold">{{ $educations->firstItem() }}</span>
                                -
                                <span class="font-semibold">{{ $educations->lastItem() }}</span>
                                dari
                                <span class="font-semibold">{{ $educations->total() }}</span>
                                data
                            </p>

                            {{ $educations->onEachSide(1)->links('pagination::tailwind') }}

                        </div>
                    </div>
                @endif


            </x-admin.table>
        </x-admin.card>

        {{ $educations->links() }}

        <!-- DELETE MODAL -->
        <div x-show="deleteModal" x-cloak>

            <div class="fixed inset-0 bg-black/50 z-50" @click="deleteModal = false"></div>

            <div class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-2xl shadow-xl w-96">

                    <h2 class="text-xl font-bold text-gray-800 mb-3">
                        Hapus Edukasi
                    </h2>

                    <p class="text-gray-600 mb-6">
                        Data edukasi akan dihapus permanen. Yakin ingin melanjutkan?
                    </p>

                    <div class="flex justify-end gap-3">

                        <button @click="deleteModal = false" class="px-4 py-2 bg-gray-200 rounded-xl">
                            Batal
                        </button>

                        <form method="POST" :action="'/admin/education/' + deleteId">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl">
                                Ya, Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
