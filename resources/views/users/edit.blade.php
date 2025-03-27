<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('error'))
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif


                    <h2 class="text-lg font-semibold">Editar Usuário</h2>
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                   required
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        </div>

                        <div class="mb-4">
                            <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data Nascimento</label>
                            <input type="data_nascimento" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento', $user->data_nascimento) }}"
                                   required
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        </div>

                        <div class="mb-4">
                            <label for="contato" class="block text-sm font-medium text-gray-700">Contato</label>
                            <input type="text" name="contato" id="contato" value="{{ old('contato', $user->contato) }}"
                                   required
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                                   oninput="this.value=this.value.replace(/[^\d]/g,'')"
                            minlength="11"
                            maxlength="11"
                            placeholder="Digite apenas números" />
                        </div>


                        <div class="mb-4">
                            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="endereco" name="endereco" id="endereco" value="{{ old('endereco', $user->endereco) }}"
                                   required
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Senha (deixe em branco
                                para manter)</label>
                            <input type="password" name="password" id="password"
                                   class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                        </div>

{{--                        <div class="mb-4">--}}
{{--                            <label for="nivel_id" class="block text-sm font-medium text-gray-700">Nível</label>--}}
{{--                            <select name="nivel_id" id="nivel_id"--}}
{{--                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">--}}
{{--                                <option value="1" {{ old('nivel_id', $user->nivel_id) == 1 ? 'selected' : '' }}>--}}
{{--                                    Administrador--}}
{{--                                </option>--}}
{{--                                <option value="2" {{ old('nivel_id', $user->nivel_id) == 2 ? 'selected' : '' }}>--}}
{{--                                    Usuário--}}
{{--                                </option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        @if(auth()->user()->nivel_id == 1)
                            <div class="mb-4">
                                <label for="nivel_id" class="block text-sm font-medium text-gray-700">Nível</label>
                                <select name="nivel_id" id="nivel_id"
                                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">
                                    <option value="1" {{ old('nivel_id', $user->nivel_id) == 1 ? 'selected' : '' }}>
                                        Administrador
                                    </option>
                                    <option value="2" {{ old('nivel_id', $user->nivel_id) == 2 ? 'selected' : '' }}>
                                        Usuário
                                    </option>
                                </select>
                            </div>
                        @endif


                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Atualizar
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
