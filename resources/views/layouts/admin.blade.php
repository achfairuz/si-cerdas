<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin - Si Cerdas' }}</title>

    {{-- @vite('resources/css/app.css') --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>


<body class="bg-gray-100" x-data @click.away="deleteModal = false">

    <div x-data="{
        open: false,
        sidebarOpen: false,
        deleteModal: false,
        deleteId: null
    }">

        <!-- Overlay (Mobile) -->
        <div x-show="open" x-transition.opacity @click="open = false" class="fixed inset-0 bg-black/40 z-40 md:hidden">
        </div>

        <!-- Sidebar -->
        @include('components.admin-sidebar')

        <!-- Header -->
        <header class="bg-white shadow-md fixed top-0 right-0 left-0 md:left-64 z-30">
            <div class="flex items-center justify-between px-6 py-4">

                <!-- Toggle -->
                <button @click="open = true" class="md:hidden text-gray-700">
                    ☰
                </button>

                <h1 class="font-bold text-gray-800">
                    Dashboard Admin
                </h1>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">{{ session('username') ?? 'Admin' }}</span>


                    @if (session('photo'))
                        <img src="{{ asset(session('photo')) }}" class="w-8 h-8 rounded-full object-cover">
                    @else
                        <div
                            class="w-8 h-8 rounded-full overflow-hidden flex items-center justify-center bg-green-600 text-white text-sm font-bold">
                            {{ strtoupper(substr(session('username') ?? 'A', 0, 1)) }}
                        </div>
                    @endif



                </div>

            </div>
        </header>

        <!-- Main -->
        <main class="pt-24 md:ml-64 px-6 pb-10 min-h-screen">
            @yield('content')
        </main>

    </div>
    @stack('scripts')

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading',
                    '|',
                    'bold', 'italic', 'underline',
                    '|',
                    'bulletedList', 'numberedList',
                    '|',
                    'link',
                    '|',
                    'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

</html>
