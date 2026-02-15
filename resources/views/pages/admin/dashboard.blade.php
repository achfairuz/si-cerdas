@extends('layouts.admin')

@section('content')
    <div class="space-y-8">

        <!-- HEADER -->
        <div>
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center gap-3">
                👋 Halo {{ session('name') ?? 'Admin' }}!
            </h2>
            <p class="text-gray-500 mt-2">
                Selamat datang kembali di Dashboard Si Cerdas ✨
            </p>
        </div>

        <!-- STAT CARDS -->
        <div class="grid md:grid-cols-3 gap-8">

            <!-- USERS -->
            <div
                class="group relative bg-gradient-to-br from-green-400 to-emerald-500 
                        p-8 rounded-3xl shadow-xl text-white 
                        hover:scale-105 transition duration-300">

                <div class="absolute top-5 right-5 text-4xl opacity-20">
                    👥
                </div>

                <p class="text-sm uppercase tracking-wider opacity-80">
                    Total Kategori
                </p>

                <h3 class="text-4xl font-bold mt-3">
                    {{ $categoryCount ?? 0 }}
                </h3>

                <p class="text-sm mt-3 opacity-90">
                    📈 {{ $categoryCount ?? 0 }} dari bulan lalu
                </p>
            </div>

            <!-- ARTICLES -->
            <div
                class="group relative bg-gradient-to-br from-blue-400 to-indigo-500 
                        p-8 rounded-3xl shadow-xl text-white 
                        hover:scale-105 transition duration-300">

                <div class="absolute top-5 right-5 text-4xl opacity-20">
                    📚
                </div>

                <p class="text-sm uppercase tracking-wider opacity-80">
                    Total Artikel
                </p>

                <h3 class="text-4xl font-bold mt-3">
                    {{ $educationCount ?? 0 }}
                </h3>

                <p class="text-sm mt-3 opacity-90">
                    ✍️ Konten edukasi aktif
                </p>
            </div>

            <!-- RECIPES -->
            <div
                class="group relative bg-gradient-to-br from-purple-400 to-pink-500 
                        p-8 rounded-3xl shadow-xl text-white 
                        hover:scale-105 transition duration-300">

                <div class="absolute top-5 right-5 text-4xl opacity-20">
                    🍲
                </div>

                <p class="text-sm uppercase tracking-wider opacity-80">
                    Total Resep
                </p>

                <h3 class="text-4xl font-bold mt-3">
                    {{ $recipeCount ?? 0 }}
                </h3>

                <p class="text-sm mt-3 opacity-90">
                    👨‍🍳 Siap untuk dicoba!
                </p>
            </div>

        </div>

        <!-- EXTRA SECTION (Opsional biar lebih keren) -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mt-10">

            <h3 class="text-xl font-bold text-gray-800 mb-4">
                🚀 Aktivitas Terbaru
            </h3>

            <div class="space-y-4 text-gray-600 text-sm">

                <div class="flex justify-between border-b pb-2">
                    <span>Admin menambahkan resep baru</span>
                    <span class="text-gray-400">2 jam lalu</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span>Kategori education diperbarui</span>
                    <span class="text-gray-400">5 jam lalu</span>
                </div>

                <div class="flex justify-between">
                    <span>Pengguna baru mendaftar</span>
                    <span class="text-gray-400">Kemarin</span>
                </div>

            </div>

        </div>

    </div>
@endsection
