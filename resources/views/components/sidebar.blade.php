<div x-data="{
    openEdu: {{ request()->routeIs('education.*') ? 'true' : 'false' }},
    openRecipe: {{ request()->routeIs('recipe.*') ? 'true' : 'false' }},
    openEduCategory: null,
    openRecipeCategory: null
}"
    class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-50
       flex flex-col
       transform transition-transform duration-300
       md:translate-x-0"
    :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

    <!-- ================= HEADER ================= -->
    <div class="p-6 border-b flex items-center gap-3 shrink-0">
        <img src="{{ asset('assets/images/logo.png') }}" class="w-8" alt="Logo">
        <h2 class="text-xl font-bold text-green-700">
            Si Cerdas
        </h2>
    </div>

    <!-- ================= NAV (SCROLLABLE) ================= -->
    <nav class="flex-1 overflow-y-auto p-6 space-y-4 text-base">

        <!-- ================= BERANDA ================= -->
        <a href="{{ route('home') }}"
            class="block font-medium transition px-4 py-2 rounded-lg
            {{ request()->routeIs('home') ? 'text-green-700 bg-green-100 font-semibold' : 'hover:text-green-600' }}">
            🏠 Beranda
        </a>

        <!-- ================= EDUKASI ================= -->
        <div>
            <button @click="openEdu = !openEdu"
                class="w-full text-left flex justify-between items-center px-4 py-2 rounded-lg font-medium transition
                {{ request()->routeIs('education.*') ? 'text-green-700 bg-green-100 font-semibold' : 'hover:text-green-600' }}">
                <span>📚 Edukasi</span>
                <span x-text="openEdu ? '-' : '+'"></span>
            </button>

            <div x-show="openEdu" x-transition class="ml-4 mt-2 space-y-2">

                @forelse ($educationCategories ?? [] as $category)
                    <div>
                        <!-- CATEGORY -->
                        <button
                            @click="openEduCategory === {{ $category->id }} 
                                ? openEduCategory = null 
                                : openEduCategory = {{ $category->id }}"
                            class="w-full text-left flex justify-between items-center text-sm px-3 py-1 rounded-md transition
                            {{ request()->is('education/category/' . $category->slug)
                                ? 'text-green-700 font-semibold'
                                : 'hover:text-green-600' }}">
                            {{ $category->name }}
                            <span x-text="openEduCategory === {{ $category->id }} ? '-' : '+'"></span>
                        </button>

                        <!-- EDUCATION LIST -->
                        <div x-show="openEduCategory === {{ $category->id }}" x-transition
                            class="ml-4 mt-1 space-y-1 text-sm">

                            @forelse ($category->educations ?? [] as $education)
                                <a href="{{ route('education.show', $education->slug) }}"
                                    class="block px-2 py-1 rounded-md transition
                                    {{ request()->routeIs('education.show') && request()->route('slug') == $education->slug
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-600' }}">
                                    {{ $education->title }}
                                </a>
                            @empty
                                <span class="text-gray-400 italic text-sm">
                                    Belum ada edukasi
                                </span>
                            @endforelse

                        </div>
                    </div>
                @empty
                    <span class="text-gray-400 italic text-sm">
                        Belum ada kategori edukasi
                    </span>
                @endforelse

            </div>
        </div>

        <!-- ================= MENU SEHAT ================= -->
        <div>
            <button @click="openRecipe = !openRecipe"
                class="w-full text-left flex justify-between items-center px-4 py-2 rounded-lg font-medium transition
                {{ request()->routeIs('recipe.*') ? 'text-green-700 bg-green-100 font-semibold' : 'hover:text-green-600' }}">
                <span>🍲 Menu Sehat</span>
                <span x-text="openRecipe ? '-' : '+'"></span>
            </button>

            <div x-show="openRecipe" x-transition class="ml-4 mt-2 space-y-2">

                @forelse ($recipeCategories ?? [] as $category)
                    <div>
                        <!-- CATEGORY -->
                        <button
                            @click="openRecipeCategory === {{ $category->id }} 
                                ? openRecipeCategory = null 
                                : openRecipeCategory = {{ $category->id }}"
                            class="w-full text-left flex justify-between items-center text-sm px-3 py-1 rounded-md transition
                            {{ request()->is('recipe/category/' . $category->slug)
                                ? 'text-green-700 font-semibold'
                                : 'hover:text-green-600' }}">
                            {{ $category->name ?? '-' }}
                            <span x-text="openRecipeCategory === {{ $category->id }} ? '-' : '+'"></span>
                        </button>

                        <!-- RECIPE LIST -->
                        <div x-show="openRecipeCategory === {{ $category->id }}" x-transition
                            class="ml-4 mt-1 space-y-1 text-sm">

                            @forelse ($category->recipes ?? [] as $recipe)
                                <a href="{{ route('recipe.show', $recipe->slug) }}"
                                    class="block px-2 py-1 rounded-md transition
                                    {{ request()->routeIs('recipe.show') && request()->route('slug') == $recipe->slug
                                        ? 'text-green-700 font-semibold bg-green-50'
                                        : 'hover:text-green-600' }}">
                                    {{ $recipe->title }}
                                </a>
                            @empty
                                <span class="text-gray-400 italic text-sm">
                                    Belum ada resep
                                </span>
                            @endforelse

                        </div>
                    </div>
                @empty
                    <span class="text-gray-400 italic text-sm">
                        Belum ada menu sehat
                    </span>
                @endforelse

            </div>
        </div>

        <!-- ================= TENTANG ================= -->
        <a href="{{ route('tentang') }}"
            class="block font-medium transition px-4 py-2 rounded-lg
            {{ request()->routeIs('tentang') ? 'text-green-700 bg-green-100 font-semibold' : 'hover:text-green-600' }}">
            ℹ️ Tentang
        </a>

    </nav>
</div>
