<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Si Cerdas</title>

    @vite('resources/css/app.css')

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
</head>

<body class="min-h-screen bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">

    <div class="bg-white shadow-2xl rounded-3xl w-full max-w-md p-10">

        <!-- Logo -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-700">
                Si Cerdas
            </h1>
            <p class="text-gray-500 mt-2">
                Sahabat Ibu Hamil untuk Generasi Sehat
            </p>
        </div>

        <!-- Global Error -->
        @if ($errors->any())
            <div class="mb-6 bg-red-100 text-red-600 px-4 py-3 rounded-xl text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                    placeholder="Masukkan email" required>
            </div>

            <!-- Password -->
            <div class="mb-6" x-data="{ show: false }">
                <label class="block text-gray-700 font-semibold mb-2">
                    Password
                </label>

                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                        placeholder="Masukkan password" required>

                    <button type="button" @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                        👁
                    </button>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition duration-300">
                Login
            </button>

        </form>

    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
