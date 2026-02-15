@extends('layouts.admin')

@section('content')
    <div class="p-8 bg-gradient-to-br from-emerald-50 via-green-50 to-teal-100 min-h-screen">

        <div class="max-w-4xl mx-auto">

            <!-- HEADER PROFILE -->
            <div class="bg-white rounded-3xl shadow-2xl p-10 border border-green-100 relative overflow-hidden">

                <div class="absolute -top-10 -right-10 w-40 h-40 bg-green-200 rounded-full opacity-30 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-300 rounded-full opacity-30 blur-2xl"></div>

                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">

                    <!-- Avatar -->
                    <div class="relative">

                        @if ($user->photo)
                            <img src="{{ asset($user->photo) }}"
                                class="w-36 h-36 rounded-full object-cover shadow-lg border-4 border-green-200">
                        @else
                            <div
                                class="w-36 h-36 rounded-full bg-gradient-to-tr from-green-500 to-emerald-600 
                   flex items-center justify-center text-white text-5xl font-bold shadow-lg">
                                {{ strtoupper(substr($user->username ?? 'A', 0, 1)) }}
                            </div>
                        @endif

                        <div
                            class="absolute bottom-2 right-2 bg-white px-2 py-1 rounded-full text-xs shadow text-green-600 font-semibold">
                            🟢 Online
                        </div>

                    </div>


                    <!-- Info -->
                    <div class="text-center md:text-left flex-1">
                        <h2 class="text-3xl font-extrabold text-gray-800 mb-2">
                            {{ $user->name ?? 'Admin' }}
                        </h2>

                        <p class="text-gray-500 mb-4">
                            Role:
                            <span class="font-semibold text-green-600 capitalize">
                                {{ $user->role ?? 'Administrator' }}
                            </span>
                        </p>

                        <div class="flex flex-wrap justify-center md:justify-start gap-3">
                            <span class="px-4 py-2 bg-green-100 text-green-600 rounded-full text-sm font-medium">
                                👨‍💼 {{ ucfirst($user->role ?? 'Admin') }}
                            </span>

                            <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">
                                🛡️ Full Access
                            </span>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div>
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 
           text-white rounded-2xl shadow-lg hover:scale-105 transition transform inline-block">
                            ✏️ Edit Profile
                        </a>
                    </div>

                </div>
            </div>

            <!-- DETAIL CARD -->
            <div class="grid md:grid-cols-2 gap-6 mt-10">

                <!-- Account Info -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        📌 Informasi Akun
                    </h3>

                    <div class="space-y-4 text-sm">

                        <div class="flex justify-between">
                            <span class="text-gray-500">Username</span>
                            <span class="font-semibold text-gray-800">
                                {{ $user->username }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Email</span>
                            <span class="font-semibold text-gray-800">
                                {{ $user->email }}
                            </span>
                        </div>



                        <div class="flex justify-between">
                            <span class="text-gray-500">Status</span>
                            <span class="text-green-600 font-semibold">
                                Aktif
                            </span>
                        </div>

                    </div>
                </div>

                <!-- Security Info -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">

                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                        🔐 Keamanan Akun
                    </h3>

                    <div class="space-y-5 text-sm">

                        <!-- Password -->
                        <div class="flex justify-between items-center border-b pb-3">
                            <div>
                                <p class="text-gray-500">Password</p>
                                <p class="text-xs text-gray-400">Terakhir diperbarui</p>
                            </div>

                            <span class="font-semibold text-gray-800 tracking-widest">
                                ••••••••
                            </span>
                        </div>

                        <!-- Last Login -->
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500">Login Terakhir</p>
                                <p class="text-xs text-gray-400">Waktu aktivitas terakhir</p>
                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $user->updated_at?->format('d M Y H:i') ?? '-' }}
                            </span>
                        </div>

                    </div>

                    <!-- Button -->
                    <a href="{{ route('users.password.form') }}"
                        class="mt-8 flex items-center justify-center gap-2 w-full 
        py-3 bg-gradient-to-r from-green-600 to-emerald-600
        text-white rounded-xl shadow-lg hover:scale-[1.02] 
        transition transform font-medium">

                        🔑 Ganti Password
                    </a>

                </div>


            </div>

        </div>
    </div>
@endsection
