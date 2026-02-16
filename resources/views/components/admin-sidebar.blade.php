<div x-data="{ open: false, logoutModal: false }">

    <!-- ================= SIDEBAR ================= -->
    <div class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-gray-200 z-50
                transform transition-transform duration-300 md:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

        <!-- Logo -->
        <div class="p-6 border-b border-gray-800">
            <h2 class="text-2xl font-bold text-green-400">
                Si Cerdas
            </h2>
            <p class="text-xs text-gray-400">Admin Panel</p>
        </div>

        <!-- Menu -->
        <nav class="p-6 space-y-4 text-sm">

            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 text-white' : 'hover:bg-gray-800' }}">
                Dashboard
            </a>

            <a href="{{ route('categories.index') }}"
                class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('categories.index', 'categories.create', 'categories.edit')
                   ? 'bg-green-600 text-white'
                   : 'hover:bg-gray-800' }}">
                Kelola Kategori
            </a>

            <a href="{{ route('educations.index') }}"
                class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('educations.index', 'educations.create', 'educations.edit')
                   ? 'bg-green-600 text-white'
                   : 'hover:bg-gray-800' }}">
                Kelola Edukasi
            </a>

            <a href="{{ route('recipes.index') }}"
                class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('recipes.index', 'recipes.create', 'recipes.edit')
                   ? 'bg-green-600 text-white'
                   : 'hover:bg-gray-800' }}">
                Kelola Resep
            </a>

            <a href="{{ route('users.index') }}"
                class="block px-4 py-2 rounded-lg transition
               {{ request()->routeIs('users.index', 'users.create', 'users.edit', 'users.password.form')
                   ? 'bg-green-600 text-white'
                   : 'hover:bg-gray-800' }}">
                Data Pengguna
            </a>

            <hr class="border-gray-700 my-4">

            <!-- Logout Button -->
            <button @click="logoutModal = true"
                class="w-full text-left px-4 py-2 rounded-lg hover:bg-red-600 hover:text-white transition">
                Logout
            </button>

        </nav>
    </div>


    <!-- ================= MODAL LOGOUT ================= -->
    <div x-show="logoutModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black/50 z-[999]">

        <div @click.away="logoutModal = false" class="bg-white rounded-2xl shadow-2xl w-80 p-6 text-gray-800"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

            <h2 class="text-lg font-semibold mb-2">Konfirmasi Logout</h2>
            <p class="text-sm text-gray-600 mb-6">
                Apakah kamu yakin ingin keluar dari akun ini?
            </p>

            <div class="flex justify-end gap-3">
                <button @click="logoutModal = false" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">
                        Ya, Logout
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>
