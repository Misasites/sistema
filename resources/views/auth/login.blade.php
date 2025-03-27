<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="GQvFisDtbpbqkJbYZxXxuoBTTLTfTNfpSsbZwf7b">
    <meta name="theme-color" content="#000000">

    <title>Clínica Massoterapia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{--<body class="bg-white ">--}}
{{--<body class="bg-gradient-to-r from-[#c250d4] to-[#3b82f6]">--}}

{{--<body class="font-sans antialiased bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white">--}}

    <div class="font-[sans-serif]">
        <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
            <div class="grid md:grid-cols-2 items-center gap-10 max-w-6xl w-full">
                <!-- Texto informativo -->
                <div>
                    <h2 class="lg:text-5xl text-4xl font-extrabold lg:leading-[55px] text-gray-800">
                        Sistema para Avaliação de Saúde
                    </h2>
                    <p class="text-sm mt-6 text-gray-800">Faça seu agendamento já conosco.</p>
                    <p class="text-sm mt-12 text-gray-800">
                        Não tenho conta
                        <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline ml-1">
                            Cadastre-se
                        </a>
                    </p>
                </div>

{{--                <!-- Fonts -->--}}
                <link rel="preconnect" href="https://fonts.bunny.net">
                <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

                <!-- Formulário de login -->
                <form method="POST" action="{{ route('login') }}" class="max-w-md md:ml-auto w-full">
                    @csrf
                    <h3 class="text-gray-800 text-3xl font-extrabold mb-8">Acessar</h3>

                    <div class="space-y-4">
                        <!-- Campo de Email -->
                        <div>
                            <input
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent"
                                placeholder="Email address"
                                value="{{ old('email') }}"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Campo de Senha -->
                        <div>
                            <input
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent"
                                placeholder="Senha"
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Lembre-me e Esqueceu a senha -->
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center">
                                <input
                                    id="remember-me"
                                    name="remember"
                                    type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                />
                                <label for="remember-me" class="ml-3 block text-sm text-gray-800">Lembre de mim</label>
                            </div>
                            <div class="text-sm">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-500 font-semibold">
                                        Esqueceu a senha?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Botão de Login -->
                    <div class="!mt-8">
                        <button
                            type="submit"
                            class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none"
                        >
                            Acessar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

































{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
