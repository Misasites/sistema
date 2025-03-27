<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuários cadastrados') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                        <!-- Inicio da Tabela -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all" type="checkbox"
                                                   class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 white:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">Data</th>
                                    <th scope="col" class="px-4 py-3">Nome</th>
                                    <th scope="col" class="px-4 py-3">E-mail</th>
                                    <th scope="col" class="px-4 py-3">Data nascimento</th>
                                    <th scope="col" class="px-4 py-3">Contato</th>
                                    <th scope="col" class="px-4 py-3">Endereço</th>

                                    <th scope="col" class="px-4 py-3"> Nível</th>

                                    <th scope="col" class="px-4 py-3">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="p-4">
                                            <div class="flex items-center">
                                                <input type="checkbox"
                                                       class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">{{ $user->name }}</td>
                                        <td class="px-4 py-3">{{ $user->email }}</td>
                                        <td class="px-4 py-3">{{ $user->data_nascimento ? \Carbon\Carbon::parse($user->data_nascimento)->format('d/m/Y') : 'Não informado' }}</td>
                                        <td class="px-4 py-3">{{ $user->contato ?: 'Não informado' }}</td>
                                        <td class="px-4 py-3">{{ $user->endereco ?: 'Não informado' }}</td>
                                        {{--                                        <td class="px-4 py-3">--}}
                                        {{--                                            @if($user->nivel_id == 1)--}}
                                        {{--                                                ADMIN--}}
                                        {{--                                            @elseif($user->nivel_id == 2)--}}
                                        {{--                                                USER--}}
                                        {{--                                            @else--}}
                                        {{--                                                Não informado--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </td>--}}
                                        <td class="px-4 py-3">
                                            {{ $user->nivel->valor }}
                                        </td>


                                        <td class="px-4 py-3">
                                            {{-- Editar --}}

                                            <a href="{{ route('users.edit', $user->id) }}"
                                               class="block py-2 px-4 hover:bg-gray-100">Editar</a>

                                            {{-- Excluir --}}
                                            <!-- Botão para abrir o modal -->
                                            <button data-modal-target="delete-modal-{{ $user->id }}" data-modal-toggle="delete-modal-{{ $user->id }}" type="button" class="block w-full text-left py-2 px-4 text-sm text-red-600 hover:bg-gray-100">
                                                Excluir
                                            </button>

                                            <!-- Modal de confirmação -->
                                            <div id="delete-modal-{{ $user->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Conteúdo do modal -->
                                                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                                        <!-- Cabeçalho do modal -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                            <h3 class="text-xl font-semibold text-white-900 dark:text-white">
                                                                Tem certeza que deseja excluir?
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $user->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Fechar modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Corpo do modal -->
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                                Você realmente deseja excluir este usuário? Esta ação não pode ser desfeita.
                                                            </p>
                                                        </div>
                                                        <!-- Rodapé do modal -->
                                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                            <!-- Botão de cancelar -->
                                                            <button data-modal-hide="delete-modal-{{ $user->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                                Cancelar
                                                            </button>
                                                            <!-- Botão para confirmar a exclusão -->
                                                            <button id="confirm-delete-{{ $user->id }}" type="button" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                                Excluir
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Formulário de exclusão (não será enviado até a confirmação) -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <script>
                                                // Ação de excluir usuário
                                                document.getElementById('confirm-delete-{{ $user->id }}').addEventListener('click', function() {
                                                    document.getElementById('delete-form-{{ $user->id }}').submit();
                                                });
                                            </script>



                                        </td>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 mb-3 px-6 lg:px-8">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
