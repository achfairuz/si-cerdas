@extends('layouts.admin')

@section('content')
    <div x-data="{ confirmModal: false }" class="min-h-screen bg-gradient-to-br from-emerald-50 via-green-50 to-teal-100 py-12">

        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl border border-green-100 overflow-hidden">

                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 p-8 text-white">
                    <h2 class="text-3xl font-bold flex items-center gap-3">
                        ✏️ Edit Profile
                    </h2>
                    <p class="text-green-100 mt-2 text-sm">
                        Perbarui informasi akun Anda
                    </p>
                </div>

                <div class="p-10">

                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- FORM -->
                    <form id="editProfileForm" method="POST" enctype="multipart/form-data"
                        action="{{ route('users.update', $user->id) }}">

                        @csrf
                        @method('PUT')

                        <!-- FOTO -->
                        <div class="flex flex-col items-center mb-10">
                            <div class="relative group">
                                <div class="w-36 h-36 rounded-full overflow-hidden shadow-xl border-4 border-green-200">
                                    @if ($user->photo)
                                        <img src="{{ asset($user->photo) }}" class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-tr from-green-500 to-emerald-600
                                                flex items-center justify-center text-white text-5xl font-bold">
                                            {{ strtoupper(substr($user->username, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <label class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow cursor-pointer">
                                    📷
                                    <input type="file" name="photo" class="hidden">
                                </label>
                            </div>
                        </div>

                        <!-- GRID -->
                        <div class="grid md:grid-cols-2 gap-8">

                            <div>
                                <label class="block text-sm font-semibold mb-2">Username</label>
                                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                    class="w-full border rounded-2xl px-5 py-3 focus:ring-2 focus:ring-green-500 shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full border rounded-2xl px-5 py-3 focus:ring-2 focus:ring-green-500 shadow-sm">
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="mt-12 flex justify-end gap-4">
                            <a href="{{ route('users.index') }}"
                                class="px-6 py-3 bg-gray-200 rounded-2xl hover:bg-gray-300 transition">
                                Batal
                            </a>

                            <!-- Trigger Modal -->
                            <button type="button" @click="confirmModal = true"
                                class="px-10 py-3 bg-gradient-to-r from-green-600 to-emerald-600
                                       text-white rounded-2xl shadow-lg hover:scale-105 transition transform font-semibold">
                                💾 Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL KONFIRMASI -->
        <div x-show="confirmModal" x-transition x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="confirmModal = false"></div>

            <!-- Modal Box -->
            <div class="relative bg-white rounded-3xl shadow-2xl w-[420px] p-8">

                <h3 class="text-xl font-bold text-gray-800 mb-4">
                    ⚠️ Konfirmasi Perubahan
                </h3>

                <p class="text-gray-600 mb-6 text-sm">
                    Apakah Anda yakin ingin mengubah profile? <br>
                    Setelah disimpan, Anda akan logout untuk memperbarui sesi login.
                </p>

                <div class="flex justify-end gap-3">
                    <button @click="confirmModal = false"
                        class="px-4 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
                        Batal
                    </button>

                    <!-- Submit Form -->
                    <button type="submit" form="editProfileForm"
                        class="px-6 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition">
                        Ya, Simpan & Logout
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection
