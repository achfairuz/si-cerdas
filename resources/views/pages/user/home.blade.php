@php use Illuminate\Support\Str; @endphp

@extends('layouts.layout')

@section('content')
    {{-- hero --}}
    <section x-data="{
        active: 0,
        slides: [
            { title: '🌱 Cegah Stunting Sejak Dini', desc: 'Pencegahan dimulai sejak masa kehamilan melalui asupan gizi dan pemeriksaan rutin.' },
            { title: '🥗 Penuhi Gizi Ibu & Janin', desc: 'Nutrisi seimbang membantu pertumbuhan optimal dan menjaga kesehatan ibu.' },
            { title: '🩺 Pantau Kesehatan Berkala', desc: 'Kontrol rutin membantu mendeteksi risiko sejak awal.' }
        ]
    }" x-init="setInterval(() => { active = (active + 1) % slides.length }, 4000)"
        class="relative text-center overflow-hidden py-20 bg-gradient-to-br from-green-50 to-green-100 rounded-3xl mt-12">

        <div class="relative h-48 flex items-center justify-center">

            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="active === index" x-transition.opacity.duration.700ms
                    class="absolute inset-0 flex flex-col items-center justify-center px-6">

                    <h2 class="text-3xl md:text-4xl font-bold text-green-700 mb-4" x-text="slide.title"></h2>
                    <p class="text-gray-600 text-lg max-w-xl" x-text="slide.desc"></p>

                </div>
            </template>

        </div>

        <div class="flex justify-center space-x-3 mt-6">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="active = index" class="w-3 h-3 rounded-full transition"
                    :class="active === index ? 'bg-green-600 scale-125' : 'bg-green-200'">
                </button>
            </template>
        </div>

    </section>


    {{-- Edukasi --}}
    @if ($latestEducation)
        <section class="mt-16">

            <div class="bg-white rounded-[40px] shadow-xl p-10 md:p-14">

                <div class="flex flex-col md:flex-row items-center gap-12">

                    <div class="flex-1 space-y-6">

                        <span class="text-sm font-bold text-pink-500 uppercase tracking-wide">
                            📚 Edukasi Terbaru
                        </span>

                        <h3 class="text-3xl md:text-4xl font-bold text-gray-800 leading-snug">
                            {{ $latestEducation->title }}
                        </h3>

                        <p class="text-gray-600 text-lg leading-relaxed">
                            {!! Str::limit(strip_tags($latestEducation->description), 180) !!}
                        </p>

                        <a href="{{ route('education.show', $latestEducation->slug) }}"
                            class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-2xl font-semibold transition inline-block shadow-md hover:scale-105 transform">
                            💕 Baca Selengkapnya
                        </a>

                    </div>

                    <div class="flex-1">
                        <div class="bg-pink-50 rounded-3xl p-6 flex items-center justify-center shadow-inner">
                            <img src="{{ $latestEducation->imageUrl }}" class="w-60 md:w-72 object-contain rounded-2xl">
                        </div>
                    </div>

                </div>

            </div>

        </section>
    @endif


    {{-- Resep --}}
    @if ($latestRecipe)
        <section class="mt-16">

            <div class="text-center mb-10">
                <h3 class="text-3xl font-bold text-green-700">
                    🍲 Menu Sehat Terbaru
                </h3>
                <p class="text-gray-600 mt-3">
                    Rekomendasi menu bergizi untuk ibu & janin
                </p>
            </div>

            <div class="bg-white rounded-[40px] shadow-xl overflow-hidden md:flex items-center">

                <div class="md:w-1/2 p-8 flex justify-center">
                    <img src="{{ $latestRecipe->imageUrl }}"
                        class="w-full max-w-md h-72 object-cover rounded-3xl shadow-lg hover:scale-105 transition">
                </div>

                <div class="p-10 md:w-1/2 flex flex-col justify-center space-y-6">

                    <h4 class="text-2xl font-bold text-gray-800">
                        {{ $latestRecipe->title }}
                    </h4>

                    <p class="text-gray-600 leading-relaxed">
                        {{ Str::limit($latestRecipe->description, 180) }}
                    </p>

                    <div class="flex gap-6 text-sm font-medium text-green-600">
                        <span>🍽 {{ $latestRecipe->portion }} Porsi</span>
                        <span>⏱ {{ $latestRecipe->duration }} menit</span>
                    </div>

                    <a href="{{ route('recipe.show', $latestRecipe->slug) }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-2xl font-semibold transition w-fit shadow-md hover:scale-105 transform">
                        🌿 Lihat Resep Lengkap
                    </a>

                </div>

            </div>

        </section>
    @endif



    {{-- Kalkulator --}}
    {{-- <section class="mt-16 bg-green-50 py-16 rounded-3xl">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-green-700">
                🤰 Kalkulator BMI Ibu Hamil
            </h3>
            <p class="text-gray-600 mt-3">
                Yuk cek kondisi tubuh sebelum hamil agar kehamilan makin sehat 💚
            </p>
        </div>

        <div x-data="{
            berat: '',
            tinggi: '',
            hasil: null,
            kategori: '',
            rekomendasi: '',
            warna: 'green',
            hitung() {
                if (!this.berat || !this.tinggi) return;
        
                let t = this.tinggi / 100
                let bmi = this.berat / (t * t)
                this.hasil = bmi.toFixed(1)
        
                if (bmi < 18.5) {
                    this.kategori = 'Berat Badan Kurang 😢'
                    this.rekomendasi = 'Rekomendasi kenaikan: 12.5 - 18 kg'
                    this.warna = 'yellow'
                } else if (bmi < 25) {
                    this.kategori = 'Normal 😊'
                    this.rekomendasi = 'Rekomendasi kenaikan: 11.5 - 16 kg'
                    this.warna = 'green'
                } else if (bmi < 30) {
                    this.kategori = 'Berat Badan Berlebih 😅'
                    this.rekomendasi = 'Rekomendasi kenaikan: 7 - 11.5 kg'
                    this.warna = 'orange'
                } else {
                    this.kategori = 'Obesitas ⚠️'
                    this.rekomendasi = 'Rekomendasi kenaikan: 5 - 9 kg'
                    this.warna = 'red'
                }
            }
        }" class="bg-white rounded-[40px] shadow-xl p-10 md:p-14 max-w-3xl mx-auto relative">

            <!-- Cute Decoration -->
            <div class="absolute -top-6 -right-6 text-6xl opacity-20">
                💚
            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        ⚖️ Berat Badan (kg)
                    </label>
                    <input type="number" x-model="berat"
                        class="w-full border-2 border-green-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                        placeholder="Contoh: 55">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        📏 Tinggi Badan (cm)
                    </label>
                    <input type="number" x-model="tinggi"
                        class="w-full border-2 border-green-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                        placeholder="Contoh: 160">
                </div>

            </div>

            <button @click="hitung()"
                class="mt-8 bg-gradient-to-r from-green-500 to-green-600 hover:scale-105 transform transition text-white px-6 py-3 rounded-2xl font-bold w-full shadow-md">
                💚 Hitung Sekarang
            </button>

            <!-- RESULT -->
            <div x-show="hasil" x-transition.scale.duration.400ms
                class="mt-10 p-8 rounded-3xl text-center space-y-4 shadow-inner"
                :class="{
                    'bg-green-100 text-green-700': warna === 'green',
                    'bg-yellow-100 text-yellow-700': warna === 'yellow',
                    'bg-orange-100 text-orange-700': warna === 'orange',
                    'bg-red-100 text-red-700': warna === 'red'
                }">

                <p class="text-lg font-semibold">
                    🎉 Hasil BMI Anda
                </p>

                <p class="text-5xl font-bold" x-text="hasil"></p>

                <p class="text-lg font-medium" x-text="kategori"></p>

                <p class="text-sm opacity-80" x-text="rekomendasi"></p>

            </div>

        </div>

    </section> --}}

    <section class="py-24 bg-gradient-to-br from-emerald-100 via-green-50 to-teal-100 relative overflow-hidden mt-4">

        <!-- Decorative Blur -->
        <div class="absolute -top-20 -left-20 w-72 h-72 bg-emerald-300 opacity-30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-72 h-72 bg-teal-300 opacity-30 rounded-full blur-3xl"></div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">

            <!-- Heading -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-emerald-700">
                    🩺 Kalkulator Status Gizi (LILA)
                </h2>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">
                    Yuk cek status gizi dengan cepat dan mudah 💚
                </p>
            </div>

            <div x-data="kalkulatorLila()" class="grid md:grid-cols-2 gap-12 items-start">

                <!-- LEFT SIDE -->
                <div class="space-y-8">

                    <!-- FORM CARD -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-emerald-200">

                        <div class="space-y-6">

                            <div>
                                <label class="font-semibold text-gray-700 flex items-center gap-2">
                                    🎂 LILA standar sesuai usia (cm)
                                </label>
                                <input type="number" step="0.1" x-model="usia"
                                    class="w-full mt-3 p-4 rounded-xl border focus:ring-2 focus:ring-emerald-400 shadow-sm">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700 flex items-center gap-2">
                                    📏 LILA Aktual (cm)
                                </label>
                                <input type="number" step="0.1" x-model="lilaAktual"
                                    class="w-full mt-3 p-4 rounded-xl border focus:ring-2 focus:ring-emerald-400 shadow-sm">
                            </div>

                            <button @click="hitung()"
                                class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:scale-105 text-white font-bold py-3 rounded-xl shadow-lg transition">
                                🚀 Hitung Sekarang
                            </button>

                        </div>
                    </div>

                    <!-- STANDAR CARD -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-emerald-200">

                        <h4 class="font-bold text-emerald-700 mb-6 text-lg">
                            📊 Standar LILA Berdasarkan Usia
                        </h4>

                        <div class="grid grid-cols-2 gap-4 text-sm">

                            <div class="bg-emerald-50 p-3 rounded-xl flex justify-between">
                                <span>16–16,9</span>
                                <span class="font-semibold">25,8 cm</span>
                            </div>

                            <div class="bg-emerald-50 p-3 rounded-xl flex justify-between">
                                <span>17–17,9</span>
                                <span class="font-semibold">26,9 cm</span>
                            </div>

                            <div class="bg-emerald-50 p-3 rounded-xl flex justify-between">
                                <span>18–18,9</span>
                                <span class="font-semibold">25,7 cm</span>
                            </div>

                            <div class="bg-emerald-50 p-3 rounded-xl flex justify-between">
                                <span>19–24,9</span>
                                <span class="font-semibold">26,5 cm</span>
                            </div>

                            <div class="bg-emerald-50 p-3 rounded-xl flex justify-between">
                                <span>25–44,9</span>
                                <span class="font-semibold">27,7 cm</span>
                            </div>

                            <div class="bg-emerald-50 p-3 rounded-xl flex justify-between">
                                <span>45–54,9</span>
                                <span class="font-semibold">29,0 cm</span>
                            </div>

                            <div class="bg-emerald-50 p-3 rounded-xl flex justify-between col-span-2">
                                <span>55–69,9</span>
                                <span class="font-semibold">30,3 cm</span>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT SIDE OUTPUT -->
                <div class="bg-white p-10 rounded-3xl shadow-2xl border border-emerald-200 text-center"
                    x-show="hasil !== null" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

                    <h3 class="text-2xl font-bold text-gray-700 mb-6">
                        🎉 Hasil Perhitungan
                    </h3>

                    <div class="text-6xl font-extrabold text-emerald-600 mb-6" x-text="hasil + '%'">
                    </div>

                    <!-- Progress -->
                    <div class="w-full bg-gray-200 rounded-full h-4 mb-6 overflow-hidden">
                        <div class="h-4 rounded-full transition-all duration-700" :style="'width: ' + hasil + '%'"
                            :class="warnaBg">
                        </div>
                    </div>

                    <div class="text-2xl font-bold mb-4" :class="warnaStatus" x-text="emoji + ' ' + status">
                    </div>

                    <div class="bg-emerald-50 rounded-xl p-4 text-sm text-gray-600">
                        Rumus: (LILA Aktual / LILA Standar) × 100%
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

<script>
    function kalkulatorLila() {
        return {
            usia: '',
            lilaAktual: '',
            hasil: null,
            status: '',
            warnaStatus: '',
            warnaBg: '',
            emoji: '',
            standar: null,

            getStandarLila() {
                let u = parseFloat(this.usia);

                if (u >= 16 && u < 17) return 25.8;
                if (u >= 17 && u < 18) return 26.9;
                if (u >= 18 && u < 19) return 25.7;
                if (u >= 19 && u < 25) return 26.5;
                if (u >= 25 && u < 45) return 27.7;
                if (u >= 45 && u < 55) return 29.0;
                if (u >= 55 && u <= 69.9) return 30.3;

                return null;
            },

            hitung() {
                let standar = this.getStandarLila();
                this.standar = standar;

                if (!standar || !this.lilaAktual) {
                    alert("Data tidak valid!");
                    return;
                }

                let persen = (this.lilaAktual / standar) * 100;
                this.hasil = persen.toFixed(1);

                if (persen > 120) {
                    this.status = "Obesitas";
                    this.emoji = "🔴";
                    this.warnaStatus = "text-red-600";
                    this.warnaBg = "bg-red-500";
                } else if (persen >= 110) {
                    this.status = "Overweight";
                    this.emoji = "🟠";
                    this.warnaStatus = "text-orange-500";
                    this.warnaBg = "bg-orange-500";
                } else if (persen >= 84) {
                    this.status = "Gizi Baik";
                    this.emoji = "🟢";
                    this.warnaStatus = "text-green-600";
                    this.warnaBg = "bg-green-500";
                } else if (persen >= 70) {
                    this.status = "Gizi Kurang";
                    this.emoji = "🟡";
                    this.warnaStatus = "text-yellow-500";
                    this.warnaBg = "bg-yellow-400";
                } else {
                    this.status = "Gizi Buruk";
                    this.emoji = "⚠️";
                    this.warnaStatus = "text-red-700";
                    this.warnaBg = "bg-red-700";
                }
            }
        }
    }
</script>
