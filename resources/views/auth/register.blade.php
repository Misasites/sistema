<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Data Nascimento Address -->
        <div class="mt-4">
            <x-input-label for="data_nascimento" :value="__('Data nascimento')" />

            <x-text-input id="data_nascimento" class="block mt-1 w-full"
                          type="date"
                          name="data_nascimento"
                          required autocomplete="new-data_nascimento" />
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
        </div>

        <!-- Contato Address -->
            <div class="mt-4" x-data>
                <x-input-label for="contato" :value="__('Contato')" />

                <x-text-input id="contato" class="block mt-1 w-full"
                              type="text"
                              name="contato"
                              placeholder="Digite apenas números"
                              required autocomplete="new-contato"
                              oninput="this.value=this.value.replace(/[^\d]/g,'')"
                minlength="11"
                maxlength="11"
                />

                <x-input-error :messages="$errors->get('contato')" class="mt-2" />
            </div>



            <!-- Endereço Address -->
        <div class="mt-4">
            <x-input-label for="endereco" :value="__('Endereco')" />

            <x-text-input id="endereco" class="block mt-1 w-full"
                          type="text"
                          name="endereco"
                          required autocomplete="new-endereco" />

            <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 to-pink-500  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Já está cadastrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
