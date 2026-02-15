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

    <div class="bg-gray-50 min-h-screen py-14">
        <div class="max-w-4xl mx-auto px-6">

            <!-- Breadcrumb -->
            <div class="text-sm text-gray-500 mb-8">
                <a href="{{ route('home') }}" class="hover:text-green-600 transition">
                    Beranda
                </a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">
                    {{ optional($education->category)->name ?? 'Tanpa Kategori' }}
                </span>
            </div>

            <article class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- Hero Image -->
                @if ($education->imageUrl)
                    <div class="h-80 w-full overflow-hidden">
                        <img src="{{ $education->imageUrl }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-500"
                            alt="{{ $education->title }}">
                    </div>
                @endif

                <div class="p-8 md:p-12">

                    <!-- Category Badge -->
                    <div class="mb-4">
                        <span class="inline-block bg-green-100 text-green-700 text-sm font-medium px-4 py-1 rounded-full">
                            {{ optional($education->category)->name ?? 'Tanpa Kategori' }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-800 leading-tight mb-4">
                        {{ $education->title }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="text-sm text-gray-500 mb-8 flex items-center gap-4">
                        <span>
                            Terakhir diperbarui:
                            {{ $education->updated_at->format('d M Y') }}
                        </span>
                    </div>

                    <!-- Divider -->
                    <div class="w-16 h-1 bg-green-600 rounded-full mb-10"></div>

                    <!-- YouTube Embed -->
                    @if ($youtubeId)
                        <div class="mb-12">
                            <div class="relative w-full rounded-2xl overflow-hidden shadow-lg" style="padding-top: 56.25%;">
                                <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                    class="absolute top-0 left-0 w-full h-full"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @elseif($education->link)
                        <div class="mb-10">
                            <a href="{{ $education->link }}" target="_blank"
                                class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-xl shadow hover:bg-green-700 transition">
                                Buka Link Sumber
                            </a>
                        </div>
                    @endif

                    <!-- Content -->
                    <div
                        class="prose prose-lg max-w-none 
                            prose-headings:text-green-700
                            prose-a:text-green-600
                            prose-strong:text-gray-800
                            prose-li:marker:text-green-600">
                        {!! $education->description !!}
                    </div>

                </div>
            </article>

            <!-- Back Button -->
            <div class="mt-10">
                <a href="{{ url()->previous() }}" class="text-green-600 hover:underline font-medium">
                    ← Kembali
                </a>
            </div>

        </div>
    </div>
@endsection
