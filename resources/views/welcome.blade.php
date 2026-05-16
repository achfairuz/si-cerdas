<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Cerdas</title>

    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">

    <div x-data="{ open: false }" class="flex min-h-screen">

        <!-- Overlay (Mobile Only) -->
        <div x-show="open" x-transition.opacity @click="open = false"
            class="fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden"></div>

        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="flex-1">

            <!-- Navbar -->
            <header class="bg-white shadow-md fixed md:static w-full z-30">
                <div class="flex items-center justify-between px-6 py-4">

                    <!-- Menu Button (Mobile Only) -->
                    <button @click="open = true" class="text-gray-700 md:hidden focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Title -->
                    <div class="flex flex-col items-start text-left">
                        <h1 class="text-lg md:text-2xl font-extrabold text-green-700 leading-tight tracking-wide font-[Nunito]">
                            Si Cerdas
                        </h1>
                        <p class="text-xs md:text-sm text-gray-600">
                            Aplikasi tepat ibu hamil untuk cegah stunting
                        </p>
                    </div>

                    <!-- Logo -->
                    <div class="bg-green-200 px-4 py-2 rounded-xl text-green-800 font-semibold">
                        Logo
                    </div>

                </div>
            </header>

            <!-- Page Content -->
            <main class="pt-24 md:pt-6 px-6 pb-10">

                <section class="text-center space-y-6">
                    <h2 class="text-3xl font-bold text-green-700">
                        Cegah Stunting Bersama Si Cerdas
                    </h2>

                    <p class="text-gray-600 text-lg">
                        Informasi edukasi gizi dan kesehatan ibu & anak sejak masa kehamilan
                    </p>
                </section>

                <section class="mt-10">
                    <h3 class="text-2xl font-semibold text-gray-800">
                        Cegah Stunting Sejak Dalam Kandungan
                    </h3>
                </section>

                <section class="mt-6">
                    <div class="bg-green-200 rounded-3xl h-64 flex items-center justify-center">
                        <p class="text-green-700 font-semibold text-lg">
                            Ilustrasi Ibu Hamil & Anak
                        </p>
                    </div>
                </section>

            </main>

            <!-- Footer -->
            <footer class="bg-green-700 text-white text-center py-6">
                <h4 class="text-xl font-semibold">Contact Us</h4>
            </footer>

        </div>

    </div>

</body>

</html>