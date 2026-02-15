@extends('layouts.layout')

@section('content')
    <div class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen md:py-14">
        <div class="max-w-4xl mx-auto md:px-6">

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- HEADER -->
                <div class="bg-green-600 p-10 text-center text-white">

                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="{{ asset('assets/images/author.jpg') }}" alt="Najla Safna Putri Nur Aura"
                            class="w-full h-full object-cover">
                    </div>

                    <h1 class="text-3xl font-bold mt-6">
                        Najla Safna Putri Nur Aura
                    </h1>

                    <p class="text-green-100 mt-2">
                        Mahasiswa D-IV Gizi Klinik | Inovator Edukasi Gizi & Pencegahan Stunting
                    </p>

                </div>

                <!-- CONTENT -->
                <div class="p-10 space-y-10">

                    <!-- Tentang -->
                    <div>
                        <h2 class="text-xl font-bold text-green-700 mb-4">
                            📌 Tentang Penulis
                        </h2>

                        <p class="text-gray-600 leading-relaxed">
                            Najla Safna Putri Nur Aura lahir di Tuban pada 10 Juni 2004.
                            Saat ini merupakan mahasiswa aktif Program Studi D-IV Gizi Klinik
                            di Politeknik Negeri Jember. Penulis memiliki minat dan fokus
                            dalam bidang pencegahan stunting melalui pendekatan edukasi gizi
                            berbasis inovasi dan teknologi.
                        </p>
                    </div>

                    <!-- Pendidikan -->
                    <div>
                        <h2 class="text-xl font-bold text-green-700 mb-4">
                            🎓 Riwayat Pendidikan
                        </h2>

                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>TK Dharmawanita VIII</li>
                            <li>SDN Sugihwaras 1 Parengan</li>
                            <li>SMP Plus Al-Fatimah Bojonegoro</li>
                            <li>SMA Darul Ulum 1 Unggulan Peterongan Jombang</li>
                            <li>D-IV Gizi Klinik, Politeknik Negeri Jember (Mahasiswa Aktif)</li>
                        </ul>
                    </div>

                    <!-- Karya Ilmiah -->
                    <div>
                        <h2 class="text-xl font-bold text-green-700 mb-4">
                            📚 Karya Ilmiah
                        </h2>

                        <p class="text-gray-600 leading-relaxed">
                            Penulis telah menghasilkan karya ilmiah berupa buku MP-ASI
                            berjudul <span class="font-semibold text-green-700">
                                “Food Recipes Anti Stunting Berbasis Augmented Reality”
                            </span>,
                            yang mengintegrasikan edukasi gizi dengan teknologi augmented reality
                            sebagai media pembelajaran inovatif dalam pencegahan stunting.
                        </p>
                    </div>

                    <!-- Prestasi -->
                    <div>
                        <h2 class="text-xl font-bold text-green-700 mb-4">
                            🏆 Prestasi
                        </h2>

                        <p class="text-gray-600 leading-relaxed">
                            Penulis pernah mengikuti kompetisi nasional di bidang
                            Dietetic Contest dan berhasil meraih Juara 3 tingkat nasional.
                        </p>
                    </div>

                </div>

            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ url()->previous() }}" class="text-green-600 font-medium hover:underline">
                    ← Kembali
                </a>
            </div>

        </div>
    </div>
@endsection
