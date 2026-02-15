<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Si Cerdas' }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title ?? 'Si Cerdas' }}">
    <meta property="og:description" content="Platform edukasi kesehatan dan resep sehat untuk keluarga.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:type" content="website">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<script>
    function slider() {
        return {
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
            ],
            init() {
                setInterval(() => {
                    this.active = (this.active + 1) % this.slides.length
                }, 4000)
            }
        }
    }
</script>

<body class="bg-gray-100 font-sans">

    <div x-data="{ open: false }" class="min-h-screen">

        <!-- Overlay (Mobile Only) -->
        <div x-show="open" x-transition.opacity @click="open = false" class="fixed inset-0 bg-black/40 z-40 md:hidden">
        </div>

        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Header -->
        <header class="bg-white shadow-md fixed top-0 right-0 left-0 md:left-64 z-30">
            <div class="flex items-center justify-between px-6 py-4">

                <!-- Menu Button (Mobile Only) -->
                <button @click="open = true" class="text-gray-700 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <h1 class="text-xl font-bold text-green-700">
                    Si Cerdas
                </h1>


                <img src="assets/images/logo.png" class="w-12" alt="Logo">


            </div>
        </header>

        <!-- Main Content -->
        <main class="pt-24 md:ml-64 px-6 pb-10">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('components.footer')

    </div>

</body>

</html>
