@extends('layouts.layout')

@section('content')
    <section x-data="{
        active: 0,
        slides: [{
                title: 'Cegah Stunting Sejak Dini',
                desc: 'Pencegahan stunting dimulai sejak masa kehamilan melalui asupan gizi yang cukup dan pemeriksaan rutin.'
            },
            {
                title: 'Penuhi Gizi Ibu & Janin',
                desc: 'Nutrisi yang seimbang membantu pertumbuhan optimal janin dan menjaga kesehatan ibu selama kehamilan.'
            },
            {
                title: 'Pantau Kesehatan Secara Berkala',
                desc: 'Kontrol kehamilan secara rutin membantu mendeteksi risiko sejak awal dan mencegah komplikasi.'
            }
        ]
    }" x-init="setInterval(() => { active = (active + 1) % slides.length }, 4000)" class="relative text-center overflow-hidden">


        <!-- Slide Container -->
        <div class="relative h-64 flex items-center justify-center">

            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="active === index" x-transition.opacity.duration.700ms
                    class="absolute inset-0 flex flex-col items-center justify-center px-6">
                    <h2 class="text-3xl font-bold text-green-700 mb-4" x-text="slide.title">
                    </h2>

                    <p class="text-gray-600 text-lg max-w-xl" x-text="slide.desc">
                    </p>
                </div>
            </template>

        </div>

        <!-- Indicator Dots -->
        <div class="flex justify-center space-x-3 mt-6">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="active = index" class="w-3 h-3 rounded-full transition"
                    :class="active === index ? 'bg-green-600 scale-110' : 'bg-gray-300'"></button>
            </template>
        </div>

    </section>

    <section class="mt-16">

        <div class="bg-white rounded-3xl shadow-lg p-8 md:p-12">

            <div class="flex flex-col md:flex-row items-center gap-10">

                <!-- TEXT -->
                <div class="flex-1 space-y-6">

                    <span class="text-sm font-semibold text-green-600 uppercase tracking-wide">
                        Pencegahan Dini
                    </span>

                    <h3 class="text-3xl md:text-4xl font-bold text-gray-800 leading-snug">
                        Cegah Stunting Sejak Dalam Kandungan
                    </h3>

                    <p class="text-gray-600 text-lg leading-relaxed">
                        Masa kehamilan adalah periode penting dalam menentukan kualitas tumbuh kembang anak.
                        Dengan pemenuhan gizi yang cukup dan pemeriksaan rutin, risiko stunting dapat dicegah sejak dini.
                    </p>

                    <button
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                        Pelajari Lebih Lanjut
                    </button>

                </div>

                <!-- IMAGE -->
                <div class="flex-1">
                    <div class="bg-green-100 rounded-3xl p-6 flex items-center justify-center">
                        <img src="/assets//images/illustrasi_ibu_hamil.png" alt="Ibu Hamil"
                            class="w-60 md:w-72 object-contain">
                    </div>
                </div>

            </div>

        </div>

    </section>

    <section class="mt-20">

        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-green-700">
                Rekomendasi Menu Sehat
            </h3>
            <p class="text-gray-600 mt-3">
                Menu bergizi untuk mendukung kesehatan ibu dan tumbuh kembang janin
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-lg overflow-hidden md:flex">

            <!-- IMAGE -->
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" alt="Salad Sehat Ibu Hamil"
                    class="h-64 md:h-full w-full object-cover">
            </div>

            <!-- CONTENT -->
            <div class="p-8 md:w-1/2 flex flex-col justify-center space-y-6">

                <h4 class="text-2xl font-bold text-gray-800">
                    Salad Sayur & Protein Tinggi
                </h4>

                <p class="text-gray-600 leading-relaxed">
                    Kombinasi sayuran hijau, telur rebus, alpukat, dan kacang-kacangan
                    yang kaya akan zat besi, asam folat, dan protein untuk mendukung
                    perkembangan janin secara optimal.
                </p>

                <!-- Nutrisi Info -->
                <div class="grid grid-cols-3 gap-4 text-center">

                    <div class="bg-green-50 p-4 rounded-xl">
                        <p class="text-green-700 font-bold text-lg">Zat Besi</p>
                        <p class="text-sm text-gray-500">Cegah Anemia</p>
                    </div>

                    <div class="bg-green-50 p-4 rounded-xl">
                        <p class="text-green-700 font-bold text-lg">Protein</p>
                        <p class="text-sm text-gray-500">Pertumbuhan Janin</p>
                    </div>

                    <div class="bg-green-50 p-4 rounded-xl">
                        <p class="text-green-700 font-bold text-lg">Folat</p>
                        <p class="text-sm text-gray-500">Perkembangan Otak</p>
                    </div>

                </div>

                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                    Lihat Resep Lengkap
                </button>

            </div>

        </div>

    </section>
    <section class="mt-20">

        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-green-700">
                Kalkulator Kesehatan Ibu Hamil
            </h3>
            <p class="text-gray-600 mt-3">
                Hitung indeks massa tubuh (BMI) untuk mengetahui rekomendasi kenaikan berat badan selama kehamilan
            </p>
        </div>

        <div x-data="{
            berat: '',
            tinggi: '',
            hasil: null,
            kategori: '',
            rekomendasi: '',
            hitung() {
                if (!this.berat || !this.tinggi) return;
        
                let t = this.tinggi / 100
                let bmi = this.berat / (t * t)
                this.hasil = bmi.toFixed(1)
        
                if (bmi < 18.5) {
                    this.kategori = 'Berat Badan Kurang'
                    this.rekomendasi = 'Rekomendasi kenaikan: 12.5 - 18 kg'
                } else if (bmi < 25) {
                    this.kategori = 'Normal'
                    this.rekomendasi = 'Rekomendasi kenaikan: 11.5 - 16 kg'
                } else if (bmi < 30) {
                    this.kategori = 'Berat Badan Berlebih'
                    this.rekomendasi = 'Rekomendasi kenaikan: 7 - 11.5 kg'
                } else {
                    this.kategori = 'Obesitas'
                    this.rekomendasi = 'Rekomendasi kenaikan: 5 - 9 kg'
                }
            }
        }" class="bg-white rounded-3xl shadow-lg p-8 md:p-12 max-w-3xl mx-auto">

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Berat Badan Sebelum Hamil (kg)
                    </label>
                    <input type="number" x-model="berat"
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 55">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        Tinggi Badan (cm)
                    </label>
                    <input type="number" x-model="tinggi"
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Contoh: 160">
                </div>

            </div>

            <button @click="hitung()"
                class="mt-6 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold transition w-full">
                Hitung BMI
            </button>

            <!-- RESULT -->
            <div x-show="hasil" x-transition class="mt-8 bg-green-50 p-6 rounded-2xl text-center space-y-3">
                <p class="text-lg font-semibold text-gray-700">
                    BMI Anda:
                </p>

                <p class="text-4xl font-bold text-green-700" x-text="hasil"></p>

                <p class="text-gray-700 font-medium" x-text="kategori"></p>

                <p class="text-sm text-gray-600" x-text="rekomendasi"></p>
            </div>

        </div>

    </section>
@endsection
