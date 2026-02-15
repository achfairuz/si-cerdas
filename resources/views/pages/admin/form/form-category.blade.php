@extends('layouts.admin')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                {{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori' }}
            </h1>
            <p class="text-sm text-gray-500">
                {{ isset($category) ? 'Perbarui data kategori' : 'Tambahkan kategori baru untuk education atau recipe' }}
            </p>
        </div>

        <div class="bg-white shadow-lg rounded-2xl p-8">

            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                method="POST" enctype="multipart/form-data">

                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif

                <!-- Nama -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Kategori
                    </label>

                    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('name') border-red-500 @enderror"
                        placeholder="Contoh: Education ...">

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Type
                    </label>

                    <select name="type"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('type') border-red-500 @enderror">

                        <option value="">-- Pilih Type --</option>

                        <option value="education" {{ old('type', $category->type ?? '') == 'education' ? 'selected' : '' }}>
                            Education
                        </option>

                        <option value="recipe" {{ old('type', $category->type ?? '') == 'recipe' ? 'selected' : '' }}>
                            Recipe
                        </option>
                    </select>

                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Gambar
                    </label>

                    @if (isset($category) && $category->imageUrl)
                        <div class="mb-3">
                            <img src="{{ asset($category->imageUrl) }}" class="w-24 h-24 object-cover rounded-lg border">
                        </div>
                    @endif

                    <input type="file" name="image"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">

                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('categories.index') }}"
                        class="px-5 py-2 rounded-xl bg-gray-200 hover:bg-gray-300 text-gray-700">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-2 rounded-xl bg-green-600 hover:bg-green-700 text-white font-semibold shadow">
                        {{ isset($category) ? 'Update' : 'Simpan' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
