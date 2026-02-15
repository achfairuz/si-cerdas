@extends('layouts.admin')

@section('content')
    <div class="p-6 space-y-6" x-data="recipeModal()">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Kelola Resep
                </h1>
                <p class="text-sm text-gray-500">
                    Manajemen data resep makanan
                </p>
            </div>

            <a href="{{ route('recipes.create') }}">
                <x-admin.button color="green">
                    + Tambah Resep
                </x-admin.button>
            </a>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card -->
        <x-admin.card>
            <x-admin.table>
                <thead>
                    <tr class="text-xs uppercase text-gray-500">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Porsi</th>
                        <th class="px-4 py-3">Durasi</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Bahan</th>
                        <th class="px-4 py-3">Langkah</th>
                        <th class="px-4 py-3">Nutrisi</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($recipes as $index => $recipe)
                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $recipes->firstItem() + $index }}
                            </td>

                            <td class="px-4 py-3">
                                @if ($recipe->imageUrl)
                                    <img src="{{ asset($recipe->imageUrl) }}"
                                        class="w-16 h-16 rounded-xl object-cover shadow">
                                @else
                                    <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 font-semibold text-gray-800">
                                {{ $recipe->title }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $recipe->portion ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $recipe->duration ?? '-' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $recipe->category->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <button type="button" @click="openIngredients({{ $recipe->id }})"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-3 py-1 rounded-full text-xs transition">
                                    {{ $recipe->ingredients->count() }}
                                </button>
                            </td>


                            <td class="px-4 py-3 text-center">
                                <button type="button" @click="openSteps({{ $recipe->id }})"
                                    class="bg-purple-100 hover:bg-purple-200 text-purple-600 px-3 py-1 rounded-full text-xs transition">
                                    {{ $recipe->steps->count() }}
                                </button>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button type="button" @click="openNutritions({{ $recipe->id }})"
                                    class="bg-green-100 hover:bg-green-200 text-green-600 px-3 py-1 rounded-full text-xs transition">
                                    {{ $recipe->nutritions->count() }}
                                </button>
                            </td>


                            <td class="px-4 py-3 text-center space-x-2">

                                <a href="{{ route('recipes.edit', $recipe->id) }}">
                                    <x-admin.button color="yellow">
                                        Edit
                                    </x-admin.button>
                                </a>

                                <x-admin.button color="red" type="button"
                                    @click="deleteModal = true; deleteId = {{ $recipe->id }}">
                                    Delete
                                </x-admin.button>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-10">
                                <div class="flex flex-col items-center space-y-3">
                                    <div class="text-gray-400 text-5xl">🍲</div>
                                    <p class="text-gray-500 font-medium">
                                        Belum ada data resep
                                    </p>

                                    <a href="{{ route('recipes.create') }}">
                                        <x-admin.button color="green">
                                            Tambah Resep
                                        </x-admin.button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </x-admin.table>
        </x-admin.card>

        <!-- Pagination -->
        @if ($recipes->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $recipes->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        @endif

        <!-- DELETE MODAL -->
        <div x-show="deleteModal" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="deleteModal = false"></div>

            <div class="relative bg-white p-6 rounded-2xl shadow-xl w-96">
                <h2 class="text-xl font-bold mb-4">Hapus Resep</h2>

                <p class="text-gray-600 mb-6">
                    Data resep akan dihapus permanen. Yakin ingin melanjutkan?
                </p>

                <div class="flex justify-end gap-3">
                    <button @click="deleteModal = false" class="px-4 py-2 bg-gray-200 rounded-xl">
                        Batal
                    </button>

                    <form method="POST" :action="'/admin/recipes/' + deleteId">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DETAIL MODAL -->
        <div x-show="showDetailModal" x-transition x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center">

            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showDetailModal = false"></div>

            <div
                class="relative bg-white w-[500px] max-h-[80vh] overflow-y-auto
                    rounded-3xl shadow-2xl p-8 border border-gray-100">

                <div class="flex items-center gap-3 mb-6">
                    <div class="text-3xl" x-text="modalIcon"></div>
                    <h2 class="text-2xl font-bold" x-text="modalTitle"></h2>
                </div>

                <template x-if="modalData.length === 0">
                    <p class="text-gray-400 text-center py-6">
                        Tidak ada data 😢
                    </p>
                </template>

                <ul class="space-y-3">
                    <template x-for="(item, index) in modalData" :key="index">
                        <li class="p-4 rounded-2xl shadow-sm border bg-gray-50">

                            <template x-if="item.ingredient">
                                <span x-text="item.ingredient"></span>
                            </template>

                            <template x-if="item.step">
                                <span x-text="(index+1) + '. ' + item.step"></span>
                            </template>

                            <template x-if="item.label">
                                <span x-text="item.label + ' : ' + item.value"></span>
                            </template>

                        </li>
                    </template>
                </ul>

                <div class="mt-8 text-right">
                    <button @click="showDetailModal = false" class="px-6 py-2 bg-gray-200 rounded-xl">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div> {{-- TUTUP x-data DI SINI --}}
@endsection

@push('scripts')
    <script>
        function recipeModal() {
            return {
                deleteModal: false,
                deleteId: null,

                showDetailModal: false,
                modalTitle: '',
                modalIcon: '',
                modalData: [],

                recipesData: @json($recipesData),

                openIngredients(id) {
                    this.modalTitle = 'Daftar Bahan'
                    this.modalIcon = '🥕'
                    this.modalData = this.recipesData[id]?.ingredients || []
                    this.showDetailModal = true
                },

                openSteps(id) {
                    this.modalTitle = 'Langkah Memasak'
                    this.modalIcon = '👩‍🍳'
                    this.modalData = this.recipesData[id]?.steps || []
                    this.showDetailModal = true
                },

                openNutritions(id) {
                    this.modalTitle = 'Informasi Nutrisi'
                    this.modalIcon = '💪'
                    this.modalData = this.recipesData[id]?.nutritions || []
                    this.showDetailModal = true
                }
            }
        }
    </script>
@endpush
