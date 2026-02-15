@extends('layouts.admin')

@section('content')
    <div class="p-8 bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen">
        <div class="max-w-6xl mx-auto bg-white shadow-2xl rounded-3xl p-10 border border-green-100" x-data="recipeForm()">

            <!-- HEADER -->
            <div class="mb-10 border-b pb-6">
                <h1 class="text-4xl font-extrabold text-gray-800 flex items-center gap-3">
                    🍲 {{ isset($recipe) ? 'Edit Resep' : 'Tambah Resep Baru' }}
                </h1>
                <p class="text-gray-500 mt-3 text-sm">
                    Buat resep yang lezat dan menarik 🍃
                </p>
            </div>

            <form method="POST" enctype="multipart/form-data"
                action="{{ isset($recipe) ? route('recipes.update', $recipe->id) : route('recipes.store') }}">
                @csrf
                @if (isset($recipe))
                    @method('PUT')
                @endif

                <!-- SECTION 1 -->
                <div class="grid md:grid-cols-2 gap-8">

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Judul Resep</label>
                        <input type="text" name="title" value="{{ old('title', $recipe->title ?? '') }}"
                            class="w-full border rounded-2xl px-5 py-3 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                            placeholder="Contoh: Mangut Lele">
                    </div>


                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Kategori</label>
                        <select name="category_id"
                            class="w-full border rounded-2xl px-5 py-3 shadow-sm focus:ring-2 focus:ring-green-500">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $recipe->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Porsi</label>
                        <input type="text" name="portion" value="{{ old('portion', $recipe->portion ?? '') }}"
                            class="w-full border rounded-2xl px-5 py-3 shadow-sm focus:ring-2 focus:ring-green-500"
                            placeholder="Untuk 8 Porsi">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Durasi</label>
                        <input type="text" name="duration" value="{{ old('duration', $recipe->duration ?? '') }}"
                            class="w-full border rounded-2xl px-5 py-3 shadow-sm focus:ring-2 focus:ring-green-500"
                            placeholder="± 45 menit">
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" class="w-full border rounded-2xl px-5 py-3 shadow-sm focus:ring-2 focus:ring-green-500"
                            rows="4" placeholder="Tulis deskripsi resep...">{{ old('description', $recipe->description ?? '') }}</textarea>
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-sm font-semibold text-gray-700">Gambar</label>
                        <input type="file" name="image" class="w-full border rounded-2xl px-5 py-3 bg-green-50">
                    </div>

                </div>

                <!-- INGREDIENT SECTION -->
                <div class="mt-14 bg-green-50 p-8 rounded-3xl shadow-inner">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        🥕 Daftar Bahan
                    </h2>

                    <template x-for="(ingredient, index) in ingredients" :key="index">
                        <div class="flex gap-4 mb-4">
                            <input type="text" name="ingredients[]" x-model="ingredients[index]"
                                class="w-full border rounded-2xl px-5 py-3" placeholder="Masukkan bahan...">

                            <button type="button" @click="ingredients.splice(index,1)"
                                class="bg-red-500 text-white px-4 rounded-2xl">
                                ✕
                            </button>
                        </div>
                    </template>


                    <button type="button" @click="ingredients.push('')"
                        class="mt-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl shadow-md transition">
                        + Tambah Bahan
                    </button>
                </div>

                <!-- STEPS SECTION -->
                <div class="mt-14 bg-yellow-50 p-8 rounded-3xl shadow-inner">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        👩‍🍳 Langkah Memasak
                    </h2>

                    <template x-for="(step, index) in steps" :key="index">
                        <div class="flex gap-4 mb-4">
                            <textarea :name="'steps[' + index + ']'" x-model="steps[index]" rows="2"
                                class="w-full border rounded-2xl px-5 py-3 shadow-sm" placeholder="Masukkan langkah..."></textarea>

                            <button type="button" @click="steps.splice(index,1)"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 rounded-2xl transition">
                                ✕
                            </button>
                        </div>
                    </template>

                    <button type="button" @click="steps.push('')"
                        class="mt-2 bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-2xl shadow-md transition">
                        + Tambah Langkah
                    </button>
                </div>

                <!-- NUTRITION SECTION -->
                <div class="mt-14 bg-purple-50 p-8 rounded-3xl shadow-inner">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        💪 Informasi Nutrisi
                    </h2>

                    <template x-for="(nutrition, index) in nutritions" :key="index">
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <input type="text" :name="'nutritions[' + index + '][label]'" x-model="nutrition.label"
                                class="border rounded-2xl px-4 py-3" placeholder="Label">

                            <input type="text" :name="'nutritions[' + index + '][value]'" x-model="nutrition.value"
                                class="border rounded-2xl px-4 py-3" placeholder="Nilai">

                            <button type="button" @click="nutritions.splice(index,1)"
                                class="bg-red-500 hover:bg-red-600 text-white rounded-2xl">
                                ✕
                            </button>
                        </div>
                    </template>

                    <button type="button" @click="nutritions.push({label:'', value:''})"
                        class="mt-2 bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-2xl shadow-md transition">
                        + Tambah Nutrisi
                    </button>
                </div>

                <!-- BUTTONS -->
                <div class="mt-16 flex justify-end gap-6">
                    <a href="{{ route('recipes.index') }}"
                        class="px-8 py-3 bg-gray-200 rounded-2xl hover:bg-gray-300 transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-10 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-2xl shadow-lg hover:scale-105 transition transform">
                        {{ isset($recipe) ? 'Update Resep' : 'Simpan Resep' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
    @php
        $defaultNutritions = [
            ['label' => 'Energi', 'value' => ''],
            ['label' => 'Protein', 'value' => ''],
            ['label' => 'Lemak', 'value' => ''],
            ['label' => 'Karbohidrat', 'value' => ''],
        ];
    @endphp
    <script>
        function recipeForm() {
            return {
                ingredients: @json($ingredients ?? ['']),
                steps: @json($steps ?? ['']),
                nutritions: @json($nutritions ?? $defaultNutritions),
            }
        }
    </script>
@endsection
