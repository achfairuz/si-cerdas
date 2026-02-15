<div x-data="{
    openEdu: false,
    openRecipe: false,
    openEduCategory: null,
    openRecipeCategory: null
}"
    class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-50
           transform transition-transform duration-300
           md:translate-x-0"
    :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">


    <!-- Header -->
    <div class="p-6 border-b flex flex-row items-center gap-2">
        <img src="assets/images/logo.png" class="w-8" alt="Logo">
        <h2 class="text-xl font-bold text-green-700">
            Si Cerdas
        </h2>
    </div>

    <nav class="p-6 space-y-4 text-lg">

        <!-- Beranda -->
        <a href="{{ route('home') }}"
            class="block font-medium transition
            {{ request()->routeIs('home') ? 'text-green-700 bg-green-100 px-4 py-2 rounded-lg' : 'hover:text-green-600' }}">
            Beranda
        </a>

        <!-- ================= EDUKASI ================= -->
        <div>
            <button @click="openEdu = !openEdu"
                class="w-full text-left flex justify-between items-center hover:text-green-600 font-medium">
                Edukasi
                <span x-text="openEdu ? '-' : '+'"></span>
            </button>

            <div x-show="openEdu" x-transition class="ml-4 mt-2 space-y-2">

                @forelse ($educationCategories ?? [] as $category)
                    <div>
                        <button
                            @click="openEduCategory === {{ $category->id }} 
                    ? openEduCategory = null 
                    : openEduCategory = {{ $category->id }}"
                            class="w-full text-left flex justify-between items-center hover:text-green-600 text-base">

                            {{ $category->name }}
                            <span x-text="openEduCategory === {{ $category->id }} ? '-' : '+'"></span>
                        </button>

                        <div x-show="openEduCategory === {{ $category->id }}" x-transition
                            class="ml-4 mt-1 space-y-1 text-sm">

                            @forelse ($category->educations ?? [] as $education)
                                <a href="{{ route('education.show', $education->slug) }}"
                                    class="block hover:text-green-600">
                                    {{ $education->title }}
                                </a>
                            @empty
                                <span class="text-gray-400 italic">
                                    Belum ada edukasi
                                </span>
                            @endforelse

                        </div>
                    </div>
                @empty
                    <span class="text-gray-400 italic">
                        Belum ada kategori edukasi
                    </span>
                @endforelse


            </div>
        </div>

        <!-- ================= RECIPE ================= -->
        <div>
            <button @click="openRecipe = !openRecipe"
                class="w-full text-left flex justify-between items-center hover:text-green-600 font-medium">
                Menu Sehat
                <span x-text="openRecipe ? '-' : '+'"></span>
            </button>

            <div x-show="openRecipe" x-transition class="ml-4 mt-2 space-y-2">

                @forelse ($recipeCategories ?? [] as $category)
                    <div>
                        <button
                            @click="openRecipeCategory === {{ $category->id }} 
                                    ? openRecipeCategory = null 
                                    : openRecipeCategory = {{ $category->id }}"
                            class="w-full text-left flex justify-between items-center hover:text-green-600 text-base">

                            {{ $category->name ?? '-' }}
                            <span x-text="openRecipeCategory === {{ $category->id }} ? '-' : '+'"></span>
                        </button>

                        <div x-show="openRecipeCategory === {{ $category->id }}" x-transition
                            class="ml-4 mt-1 space-y-1 text-sm">

                            @forelse ($category->recipes ?? [] as $content)
                                <a href="{{ route('recipe.show', $content->slug) }}"
                                    class="block hover:text-green-600">
                                    {{ $content->title }}
                                </a>
                            @empty
                                <span class="text-gray-400 italic">
                                    Belum ada resep
                                </span>
                            @endforelse

                        </div>
                    </div>
                @empty
                    <span class="text-gray-400 italic">
                        Belum ada menu sehat
                    </span>
                @endforelse

            </div>
        </div>

        <a href="#" class="block hover:text-green-600">Kontak</a>

    </nav>
</div>
