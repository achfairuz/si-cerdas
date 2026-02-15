<div class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-gray-200 z-50
           transform transition-transform duration-300
           md:translate-x-0"
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

        <a href="#" class="block px-4 py-2 rounded-lg hover:bg-red-600 hover:text-white">
            Logout
        </a>

    </nav>

</div>
