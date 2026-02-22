@extends('layouts.layout')

@section('content')
    @php
        function getYoutubeId($url)
        {
            preg_match('/(youtu\.be\/|v=)([^&]+)/', $url, $matches);
            return $matches[2] ?? null;
        }

        $youtubeId = $education->link ? getYoutubeId($education->link) : null;
    @endphp

    <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-pink-50 min-h-screen md:py-12 py-8">
        <div class="max-w-4xl mx-auto md:px-4">

            <!-- Breadcrumb Cute -->
            <div class="text-sm text-gray-500 mb-8 flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-green-600 transition">
                    🏠 Beranda
                </a>
                <span>›</span>
                <span class="text-gray-700 font-medium">
                    {{ optional($education->category)->name ?? 'Tanpa Kategori' }}
                </span>
            </div>

            <article class="bg-white md:rounded-[40px] rounded-[20px] shadow-2xl overflow-hidden">

                <!-- HERO IMAGE -->
                @if ($education->imageUrl)
                    <div class="h-80 w-full overflow-hidden relative">
                        <img src="{{ $education->imageUrl }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-500"
                            alt="{{ $education->title }}">

                        <!-- Cute Decoration -->
                        <div class="absolute top-4 right-4 text-4xl opacity-80">
                            🌸
                        </div>
                    </div>
                @endif

                <div class="p-6  md:p-14">

                    <!-- CATEGORY BADGE -->
                    <div class="mb-6">
                        <span
                            class="inline-block bg-pink-100 text-pink-600 text-sm font-semibold px-4 py-2 rounded-full shadow-sm">
                            📚 {{ optional($education->category)->name ?? 'Tanpa Kategori' }}
                        </span>
                    </div>

                    <!-- TITLE -->
                    <h1 class="text-4xl font-bold text-gray-800 leading-snug mb-6">
                        💕 {{ $education->title }}
                    </h1>

                    <!-- META -->
                    <div class="text-sm text-gray-500 mb-10 bg-green-50 p-4 rounded-2xl">
                        📅 Terakhir diperbarui:
                        {{ $education->updated_at->format('d M Y') }}
                    </div>

                    <!-- Divider Cute -->
                    <div class="flex justify-center mb-12">
                        <div class="w-24 h-1 bg-gradient-to-r from-pink-400 via-green-400 to-emerald-500 rounded-full">
                        </div>
                    </div>

                    <!-- YOUTUBE -->
                    @if ($youtubeId)
                        <div class="mb-12">
                            <div class="relative w-full rounded-3xl overflow-hidden shadow-xl" style="padding-top: 56.25%;">
                                <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                    class="absolute top-0 left-0 w-full h-full"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @elseif($education->link)
                        <div class="mb-12 text-center">
                            <a href="{{ $education->link }}" target="_blank"
                                class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-2xl shadow-md transition hover:scale-105 transform">
                                🔗 Buka Link Sumber
                            </a>
                        </div>
                    @endif

                    <!-- CONTENT -->
                    <div
                        class="prose prose-lg max-w-none 
                    prose-headings:text-green-700
                    prose-a:text-green-600
                    prose-strong:text-gray-800
                    prose-li:marker:text-green-500
                    prose-p:leading-relaxed text-justify">

                        {!! $education->description !!}
                    </div>

                </div>
            </article>

            <!-- BACK BUTTON -->
            <div class="mt-12 text-center">
                <a href="{{ url()->previous() }}"
                    class="inline-block bg-white px-6 py-3 rounded-full shadow-md text-green-600 font-semibold hover:scale-105 transition">
                    ← Kembali
                </a>
            </div>

        </div>
    </div>
@endsection
