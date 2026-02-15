@extends('layouts.admin')

@section('content')
    <div class="p-6">

        <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    {{ isset($education) ? 'Edit Edukasi' : 'Tambah Edukasi' }}
                </h1>
                <p class="text-gray-500 text-sm mt-2">
                    {{ isset($education) ? 'Perbarui data edukasi' : 'Tambahkan konten edukasi baru' }}
                </p>
            </div>

            <form method="POST" enctype="multipart/form-data"
                action="{{ isset($education) ? route('educations.update', $education->id) : route('educations.store') }}">

                @csrf
                @if (isset($education))
                    @method('PUT')
                @endif

                <div class="grid md:grid-cols-2 gap-6">

                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul
                        </label>
                        <input type="text" name="title" value="{{ old('title', $education->title ?? '') }}"
                            placeholder="Masukkan judul edukasi"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('title') border-red-500 @enderror">

                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select name="category_id"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('category_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $education->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Link -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Link Video Youtube (Optional)
                        </label>
                        <input type="url" name="link" value="{{ old('link', $education->link ?? '') }}"
                            placeholder="https://www.youtube.com/..."
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>

                        <textarea id="editor" name="description" rows="5"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none @error('description') border-red-500 @enderror">
        {{ old('description', $education->description ?? '') }}
    </textarea>

                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Gambar
                        </label>

                        @if (isset($education) && $education->imageUrl)
                            <div class="mb-4">
                                <img src="{{ asset($education->imageUrl) }}"
                                    class="w-32 h-32 object-cover rounded-xl shadow">
                            </div>
                        @endif

                        <input type="file" name="image"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-10 flex justify-end gap-4">

                    <a href="{{ route('educations.index') }}"
                        class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl text-gray-700 font-medium transition">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold shadow transition">
                        {{ isset($education) ? 'Update' : 'Simpan' }}
                    </button>

                </div>

            </form>

        </div>
    </div>
@endsection
