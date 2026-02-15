@extends('layouts.admin')

@section('content')
    <div x-data="{ confirmModal: false }" class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-100 py-12">

        <div class="max-w-xl mx-auto">

            <div class="bg-white rounded-3xl shadow-2xl border border-green-100 overflow-hidden">

                <!-- Header -->
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 p-8 text-white">
                    <h2 class="text-3xl font-bold flex items-center gap-3">
                        🔐 Ganti Password
                    </h2>
                    <p class="text-green-100 mt-2 text-sm">
                        Demi keamanan akun Anda
                    </p>
                </div>

                <div class="p-8">

                    <form id="passwordForm" method="POST" action="{{ route('users.password.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Password Lama -->
                        <div class="mb-6" x-data="{ show: false }">
                            <label class="block text-sm font-semibold mb-2">
                                Password Lama
                            </label>

                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="old_password"
                                    class="w-full border rounded-2xl px-4 py-3 pr-12 focus:ring-2 focus:ring-green-500 @error('old_password') border-red-500 @enderror">

                                <button type="button" @click="show = !show"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-green-600 transition">
                                    <span x-text="show ? '🙈' : '👁️'"></span>
                                </button>
                            </div>

                            @error('old_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Baru -->
                        <div class="mb-6" x-data="{ show: false }">
                            <label class="block text-sm font-semibold mb-2">
                                Password Baru
                            </label>

                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password"
                                    class="w-full border rounded-2xl px-4 py-3 pr-12 focus:ring-2 focus:ring-green-500 @error('password') border-red-500 @enderror">

                                <button type="button" @click="show = !show"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-green-600 transition">
                                    <span x-text="show ? '🙈' : '👁️'"></span>
                                </button>
                            </div>

                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-8" x-data="{ show: false }">
                            <label class="block text-sm font-semibold mb-2">
                                Konfirmasi Password
                            </label>

                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password_confirmation"
                                    class="w-full border rounded-2xl px-4 py-3 pr-12 focus:ring-2 focus:ring-green-500">

                                <button type="button" @click="show = !show"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-green-600 transition">
                                    <span x-text="show ? '🙈' : '👁️'"></span>
                                </button>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('users.index') }}"
                                class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-2xl transition">
                                Batal
                            </a>

                            <button type="button" @click="confirmModal = true"
                                class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 
                            text-white rounded-2xl shadow-lg hover:scale-105 transition transform">
                                💾 Simpan Password
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- POPUP MODAL -->
        <div x-show="confirmModal" x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center">

            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="confirmModal = false"></div>

            <div class="relative bg-white w-[420px] rounded-3xl shadow-2xl p-8" x-transition:enter="scale-90 opacity-0"
                x-transition:enter-end="scale-100 opacity-100" x-transition:leave="scale-100 opacity-100"
                x-transition:leave-end="scale-90 opacity-0">

                <div class="text-center">
                    <div class="text-4xl mb-4">⚠️</div>

                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        Konfirmasi Perubahan Password
                    </h3>

                    <p class="text-gray-500 text-sm mb-6">
                        Apakah Anda yakin ingin mengubah password?
                        <br>
                        Setelah berhasil, Anda akan logout otomatis.
                    </p>

                    <div class="flex justify-center gap-4">
                        <button @click="confirmModal = false"
                            class="px-5 py-2 bg-gray-200 rounded-xl hover:bg-gray-300 transition">
                            Batal
                        </button>

                        <button onclick="document.getElementById('passwordForm').submit();"
                            class="px-6 py-2 bg-gradient-to-r from-green-600 to-emerald-600
                               text-white rounded-xl shadow hover:scale-105 transition transform">
                            Ya, Ubah Password
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
