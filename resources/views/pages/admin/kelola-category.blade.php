@extends('layouts.admin')

@section('content')
    <div class="p-6 space-y-6" x-data="{
        deleteModal: false,
        deleteId: null
    }">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Kelola Kategori
                </h1>
                <p class="text-sm text-gray-500">
                    Manajemen data kategori education & recipe
                </p>
            </div>

            <a href="{{ route('categories.create') }}">
                <x-admin.button color="green">
                    + Tambah Kategori
                </x-admin.button>
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Table -->
        <x-admin.card>
            <x-admin.table>
                <thead>
                    <tr class="text-gray-500 text-xs uppercase">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr class="bg-gray-50 hover:bg-gray-100">
                            <td class="px-4 py-3">
                                {{ $categories->firstItem() + $index }}
                            </td>

                            <td class="px-4 py-3">
                                @if ($category->imageUrl)
                                    <img src="{{ asset($category->imageUrl) }}"
                                        class="w-14 h-14 object-cover rounded-xl border">
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 font-semibold text-gray-800">
                                {{ $category->name }}
                            </td>

                            <td class="px-4 py-3">
                                <x-admin.badge :type="$category->type" />
                            </td>

                            <td class="px-4 py-3 text-center space-x-2 ">

                                <a href="{{ route('categories.edit', $category->id) }}">
                                    <x-admin.button color="yellow">
                                        Edit
                                    </x-admin.button>
                                </a>

                                <x-admin.button color="red" type="button"
                                    @click="
       
        deleteModal = true; 
        deleteId = {{ $category->id }};
  
    ">
                                    Delete
                                </x-admin.button>



                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-400">
                                Belum ada data kategori
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </x-admin.table>
        </x-admin.card>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $categories->links() }}
        </div>

        <!-- DELETE MODAL (HARUS DI DALAM x-data) -->
        <div x-show="deleteModal" x-cloak>

            <div class="fixed inset-0 bg-black/50 z-50" @click="deleteModal = false"></div>

            <div class="fixed inset-0 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-2xl shadow-xl w-96">

                    <h2 class="text-xl font-bold text-gray-800 mb-3">
                        Hapus Kategori
                    </h2>

                    <p class="text-gray-600 mb-6">
                        Data kategori akan dihapus permanen. Yakin ingin melanjutkan?
                    </p>

                    <div class="flex justify-end gap-3">

                        <button @click="deleteModal = false" class="px-4 py-2 bg-gray-200 rounded-xl">
                            Batal
                        </button>

                        <form method="POST" :action="'/admin/categories/' + deleteId">
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
