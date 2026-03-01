@extends('layouts.layout')

@section('content')
    <div class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen md:py-14 py-8">
        <div class="max-w-5xl mx-auto md:px-6 ">

            <!-- Card Utama -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- Hero Image -->
                @if ($recipe->imageUrl)
                    <div class="h-80 w-full overflow-hidden relative">
                        <img src="{{ $recipe->imageUrl }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-500"
                            alt="{{ $recipe->title }}">
                    </div>
                @endif

                <div class="p-8 md:p-12">

                    <!-- Category Badge -->
                    <div class="mb-4">
                        <span class="bg-green-100 text-green-700 text-sm font-semibold px-4 py-1 rounded-full">
                            {{ optional($recipe->category)->name ?? 'Tanpa Kategori' }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-800 mb-6">
                        🍽 {{ $recipe->title }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap gap-6 text-sm text-gray-600 mb-10">
                        <div class="flex items-center gap-2">
                            ⏱ <span>{{ $recipe->duration }} </span>
                        </div>
                        <div class="flex items-center gap-2">
                            🍴 <span>{{ $recipe->portion }} porsi</span>
                        </div>
                        <div>
                            📅 Update: {{ $recipe->updated_at->format('d M Y') }}
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none mb-12">
                        {!! $recipe->description !!}
                    </div>

                    <!-- ================= INGREDIENT ================= -->
                    <div class="mb-14">
                        <h2 class="text-2xl font-bold text-green-700 mb-6">
                            🥕 Bahan-bahan
                        </h2>

                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach ($recipe->ingredients as $ingredient)
                                <div class="bg-green-50 p-4 rounded-xl shadow-sm">
                                    {{ $ingredient->ingredient }}
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <!-- ================= STEPS ================= -->
                    <div class="mb-14">
                        <h2 class="text-2xl font-bold text-green-700 mb-6">
                            👩‍🍳 Cara Membuat
                        </h2>

                        <div class="space-y-6">
                            @foreach ($recipe->steps as $index => $step)
                                <div class="flex gap-4 items-start">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center 
                                            bg-green-600 text-white rounded-full font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="bg-gray-50 p-5 rounded-2xl shadow-sm w-full">
                                        {{ $step->step }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
<!-- ================= NUTRITION ================= -->
<div class="mb-16 text-center">

    <h2 class="text-xl md:text-3xl font-bold mb-8 tracking-wide">
        KANDUNGAN GIZI PER PORSI
    </h2>

    <div class="flex gap-4 overflow-x-auto no-scrollbar px-4">

        @foreach ($recipe->nutritions as $nutrition)
            <div class="min-w-[110px] flex-shrink-0">

                <!-- Top -->
                <div class="bg-green-500 text-black font-semibold 
                            rounded-t-full py-3 text-sm">
                    {{ $nutrition->label }}
                </div>

                <!-- Bottom -->
                <div class="bg-white border border-gray-300 
                            rounded-b-full py-4 text-base font-medium">
                    {{ $nutrition->value }}
                </div>

            </div>
        @endforeach

    </div>

</div>
                  
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-10">
                <a href="{{ url()->previous() }}" class="text-green-600 font-medium hover:underline">
                    ← Kembali
                </a>
            </div>

        </div>
    </div>
@endsection
