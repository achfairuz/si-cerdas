<div class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-50
           transform transition-transform duration-300
           md:translate-x-0"
    :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

    <div class="p-6 border-b flex flex-row items-center gap-2">
        <img src="assets/images/logo.png" class="w-8" alt="Logo">
        <h2 class="text-xl font-bold text-green-700">
            Si Cerdas
        </h2>
    </div>

    <nav class="p-6 space-y-6 text-lg">
        <a href="{{ route('home') }}"
            class="block font-medium transition
   {{ request()->routeIs('home') ? 'text-green-700 bg-green-100 px-4 py-2 rounded-lg' : 'hover:text-green-600' }}">
            Beranda
        </a>

        <a href="#" class="block hover:text-green-600">Tentang</a>
        <a href="#" class="block hover:text-green-600">Edukasi Stunting</a>
        <a href="#" class="block hover:text-green-600">Menu Sehat</a>
        <a href="#" class="block hover:text-green-600">Kontak</a>
    </nav>

</div>
