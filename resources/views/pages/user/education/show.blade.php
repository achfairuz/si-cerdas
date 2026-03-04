@extends('layouts.layout')

@section('content')
    @php
        $desc = $education->description;

        /*
|--------------------------------------------------------------------------
| Convert YouTube <a href=""> menjadi iframe embed
|--------------------------------------------------------------------------
*/
        $desc = preg_replace_callback(
            '/<p>\s*<a[^>]+href="https?:\/\/(?:www\.)?youtube\.com\/watch\?v=([^"&]+)[^"]*"[^>]*>.*?<\/a>\s*<\/p>/i',
            function ($matches) {
                $videoId = $matches[1];

                return '
        <div class="my-10 not-prose">
            <div class="w-full aspect-video overflow-hidden rounded-2xl shadow-lg">
                <iframe
                    src="https://www.youtube.com/embed/' .
                    $videoId .
                    '"
                    class="w-full h-full"
                    frameborder="0"
                    allowfullscreen
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                </iframe>
            </div>
        </div>';
            },
            $desc,
        );
    @endphp
    <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-pink-50 min-h-screen md:py-12 py-8">
        <div class="max-w-4xl mx-auto md:px-4">

            <!-- Breadcrumb -->
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

                        <div class="absolute top-4 right-4 text-4xl opacity-80">
                            🌸
                        </div>
                    </div>
                @endif

                <div class="p-6 md:p-14">

                    <!-- CATEGORY -->
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

                    <!-- Divider -->
                    <div class="flex justify-center mb-12">
                        <div class="w-24 h-1 bg-gradient-to-r from-pink-400 via-green-400 to-emerald-500 rounded-full">
                        </div>
                    </div>



                    <!-- DESCRIPTION -->
                    <div
                        class="prose prose-lg max-w-none 
prose-headings:text-green-700
prose-a:text-green-600
prose-strong:text-gray-800
prose-li:marker:text-green-500
prose-p:leading-relaxed text-justify">

                        {!! $desc !!}

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
