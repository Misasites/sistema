<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Laravel Welcome</title>
    <link rel="preconnect" href="https://fonts.bunny.net"/>
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
{{--<body class="font-sans antialiased bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white">--}}
<body class="bg-white ">

<div class="min-h-screen flex flex-col items-center justify-center">
    <header class="mb-8 text-center">
        <h1 class="text-5xl font-bold tracking-tight">
            Massoterapeuta da <span class="text-yellow-300">Saúde e Beleza</span>
        </h1>
        <p class="mt-4 text-lg font-medium">
            Bem-vindo!
        </p>
    </header>

    <div class="flex gap-4">
        @if (Route::has('login'))
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="px-6 py-3 bg-green-500 rounded-lg shadow-md text-white font-semibold hover:bg-green-600 focus:ring-4 focus:ring-green-300"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="px-6 py-3 bg-blue-500 rounded-lg shadow-md text-white font-semibold hover:bg-blue-600 focus:ring-4 focus:ring-blue-300"
                >
                    Login
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="px-6 py-3 bg-pink-500 rounded-lg shadow-md text-white font-semibold hover:bg-pink-600 focus:ring-4 focus:ring-pink-300"
                    >
                        Cadastre-se
                    </a>
                @endif
            @endauth
        @endif
    </div>

    <footer class="mt-12 text-center">
        <p class="text-sm opacity-80">
            Seabra <span class="text-red-400">&hearts;</span> Bahia.
        </p>
    </footer>
</div>
</body>
</html>
