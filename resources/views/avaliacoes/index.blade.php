<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('Lista de Registros de Avaliação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                @if(session('error'))
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
{{--                    <h3 class="text-lg font-semibold">Registros de Avaliações</h3>--}}
                    <a href="{{ route('avaliacoes.create') }}"
                       class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-[#17736D] rounded-lg hover:bg-[#155D59] focus:outline-none focus:ring-4 focus:ring-[#1A8D86] transition-all duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Cadastrar Nova Avaliação
                    </a>

                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300">

                        <tr>
                            <th scope="col" class="px-6 py-3">Usuário</th>
                            <th scope="col" class="px-6 py-3">Objetivo Sessões Massoterapia</th>
                            <th scope="col" class="px-6 py-3">Nível de Estresse</th>
                            <th> Notificação Whats</th>
                            <th scope="col" class="px-6 py-3">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($avaliacoes as $avaliacao)
                            <tr class="bg-white border-b hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $avaliacao->user->name ?? 'Não especificado' }}</td>

                                <td class="px-6 py-4">{{ $avaliacao->ObjetivoSessoesMassoterapia->valor ?? 'Não especificado' }}</td>
                                <td class="px-6 py-4">{{ $avaliacao->nivelEstresse->valor ?? 'Não especificado' }}</td>
                                <td><a href="{{ route('avaliacoes.whatsapp', $avaliacao->id) }}"
                                       target="_blank"
                                       class="font-medium text-green-600 dark:text-green-500 hover:underline ">
                                        <i class="fa-brands fa-whatsapp fa-lg"></i>
                                    </a>
                                </td>

                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="dropdown-button-{{ $avaliacao->id }}" data-dropdown-toggle="dropdown-{{ $avaliacao->id }}" class="inline-flex items-center p-2 text-sm font-medium text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                        </svg>
                                    </button>
                                    <div id="dropdown-{{ $avaliacao->id }}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow-md">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdown-button-{{ $avaliacao->id }}">
                                            <li>
                                                <a href="{{ route('avaliacoes.edit', $avaliacao->id) }}" class="block py-2 px-4 hover:bg-gray-100">Editar</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('avaliacoes.show', $avaliacao->id) }}" class="block py-2 px-4 hover:bg-gray-100">Visualizar</a>
                                            </li>
                                        </ul>


                                        <!-- Modal de confirmação -->
                                        <div id="delete-modal-{{ $avaliacao->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <!-- Conteúdo do modal -->
                                                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                                    <!-- Cabeçalho do modal -->
                                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                        <h3 class="text-xl font-semibold text-white-900 dark:text-white">
                                                            Tem certeza que deseja excluir?
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $avaliacao->id }}">
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
                                                        <button data-modal-hide="delete-modal-{{ $avaliacao->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                            Cancelar
                                                        </button>
                                                        <!-- Botão para confirmar a exclusão -->
                                                        <button id="confirm-delete-{{ $avaliacao->id }}" type="button" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                            Excluir
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(auth()->user()->nivel->id == 1)
                                            <form action="{{ route('avaliacoes.destroy', $avaliacao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta avaliação?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="block w-full text-left py-2 px-4 text-sm text-red-600 hover:bg-gray-100">Excluir</button>
                                            </form>
                                        @endif



                                        <script>
                                            // Ação de excluir usuário
                                            document.getElementById('confirm-delete-{{ $avaliacao->id }}').addEventListener('click', function() {
                                                document.getElementById('delete-form-{{ $avaliacao->id }}').submit();
                                            });
                                        </script>



                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $avaliacoes->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-dropdown-toggle]').forEach(button => {
            button.addEventListener('click', () => {
                const dropdownId = button.getAttribute('data-dropdown-toggle');
                document.getElementById(dropdownId).classList.toggle('hidden');
            });
        });
    </script>
</x-app-layout>
