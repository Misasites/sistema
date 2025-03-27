<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Avaliação') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


                    <form action="{{ route('avaliacoes.update', $avaliacao->id) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <!-- 1º Você já participou de sessões de massoterapia anteriormente? -->
                        <div class="mb-4">
                            <label for="sessoes_massoterapia_anteriormente"
                                   class="block text-sm font-medium text-gray-700">Você já participou de sessões de massoterapia anteriormente?</label>
                            <select name="sessoes_massoterapia_anteriormente" id="sessoes_massoterapia_anteriormente"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($sessoes_massoterapia_anteriormente as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ $avaliacao->sessoes_massoterapia_anteriormente == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sessoes_massoterapia_anteriormente')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 2º Você possui alguma condição médica diagnosticada? -->
                        <div class="mb-4">
                            <label for="condicao_medica_diagnosticada" class="block text-sm font-medium text-gray-700">
                                Você possui alguma condição médica diagnosticada?
                            </label>
                            <select name="condicao_medica_diagnosticada" id="condicao_medica_diagnosticada"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualCondicaoMedica()">
                                @foreach ($condicao_medica_diagnosticada as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ $avaliacao->condicao_medica_diagnosticada == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Campo oculto para informar qual condição médica diagnosticada -->
                            <input type="text" name="qual_condicao_medica_diagnosticada" id="qual_diagnostico"
                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"
                                   placeholder="Informe qual condição médica diagnosticada"
                                   value="{{ old('qual_condicao_medica_diagnosticada', $avaliacao->qual_condicao_medica_diagnosticada) }}">

                            @error('qual_condicao_medica_diagnosticada')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            // Função para mostrar ou ocultar o campo de texto dependendo da seleção
                            function toggleQualCondicaoMedica() {
                                var select = document.getElementById('condicao_medica_diagnosticada');
                                var input = document.getElementById('qual_diagnostico');

                                // Se a opção "Selecione" ou qualquer outra condição que não seja específica for selecionada, oculta o campo
                                if (select.value == "1") {
                                    input.classList.add('hidden');
                                } else {
                                    input.classList.remove('hidden');
                                }
                            }

                            // Chama a função ao carregar a página, para definir o estado inicial do campo de texto
                            window.onload = function() {
                                toggleQualCondicaoMedica();
                            };
                        </script>



                        <!-- 3º Histórico de problemas de saúde física (ex.: hipertensão, diabetes, problemas respiratórios) -->
                        <div class="mb-4">
                            <label for="problema_saude_fisica" class="block text-sm font-medium text-gray-700">
                                Histórico de problemas de saúde física (ex.: hipertensão, diabetes, problemas respiratórios):
                            </label>
                            <select name="problema_saude_fisica" id="problema_saude_fisica"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualProblemaSaudeFisica()">
                                @foreach ($problema_saude_fisica as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('problema_saude_fisica', $avaliacao->problema_saude_fisica) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>


                            <!-- Campo oculto para especificar o problema de saúde -->
                            <input type="text" name="qual_problema_saude_fisica" id="qual_problema_saude_fisica"
                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm {{ empty($avaliacao->qual_problema_saude_fisica) ? 'hidden' : '' }}"
                                   placeholder="Informe qual problema de saúde física"
                                   value="{{ old('qual_problema_saude_fisica', $avaliacao->qual_problema_saude_fisica) }}">

                            @error('qual_problema_saude_fisica')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function toggleQualProblemaSaudeFisica() {
                                var select = document.getElementById('problema_saude_fisica');
                                var input = document.getElementById('qual_problema_saude_fisica');

                                // Se a opção "Nenhum" for selecionada (ou um valor que indica ausência de problemas), oculta o campo de texto
                                if (select.value === "" || select.value === "1") { // Supondo que "1" significa "Nenhum problema"
                                    input.classList.add('hidden');
                                    input.value = ""; // Limpa o campo quando ocultado
                                } else {
                                    input.classList.remove('hidden');
                                }
                            }

                            // Executa a função ao carregar a página para definir o estado inicial
                            window.onload = function() {
                                toggleQualProblemaSaudeFisica();
                            };
                        </script>









                        <!-- 4º Histórico de problemas de saúde emocional -->
                        <div class="mb-4">
                            <label for="problema_saude_emocional" class="block text-sm font-medium text-gray-700">
                                Histórico de Problemas de Saúde Emocional
                            </label>

                            <select name="problema_saude_emocional" id="problema_saude_emocional"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualProblemaSaudeEmocional()">
                                @foreach ($problema_saude_emocional as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('problema_saude_emocional', $avaliacao->problema_saude_emocional) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            @error('problema_saude_emocional')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo oculto para especificar o problema de saúde emocional -->
                        <div id="campo_outro_problema_saude_emocional"
                             class="{{ old('problema_saude_emocional', $avaliacao->problema_saude_emocional) == 6 ? '' : 'hidden' }}">
                            <input type="text" name="qual_problema_saude_emocional" id="qual_problema_saude_emocional"
                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                   placeholder="Informe qual problema de saúde emocional"
                                   value="{{ old('qual_problema_saude_emocional', $avaliacao->qual_problema_saude_emocional) }}">

                            @error('qual_problema_saude_emocional')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function toggleQualProblemaSaudeEmocional() {
                                var select = document.getElementById('problema_saude_emocional');
                                var campoOutro = document.getElementById('campo_outro_problema_saude_emocional');
                                var inputOutro = document.getElementById('qual_problema_saude_emocional');

                                console.log("Valor selecionado:", select.value); // Debug no console

                                if (select.value === "2") {
                                    campoOutro.classList.remove('hidden');
                                } else {
                                    campoOutro.classList.add('hidden');
                                    inputOutro.value = ""; // Limpa o campo quando ocultado
                                }
                            }

                            // Aguarda o carregamento da página para definir corretamente o estado inicial
                            document.addEventListener("DOMContentLoaded", function () {
                                toggleQualProblemaSaudeEmocional();
                            });
                        </script>





                        <!-- 8º Está atualmente em tratamento para alguma condição emocional ou mental? -->
                        <div class="mb-4">
                            <label for="tratamento_emocional_mental" class="block text-sm font-medium text-gray-700">
                                Está atualmente em tratamento para alguma condição emocional ou mental?
                            </label>
                            <select name="tratamento_emocional_mental" id="tratamento_emocional_mental"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualTratamentoEmocionalMental()">
                                @foreach ($tratamento_emocional_mental as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('tratamento_emocional_mental', $avaliacao->tratamento_emocional_mental) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Campo oculto para especificar qual tratamento -->
                            <input type="text" name="qual_tratamento_emocional_mental" id="qual_tratamento_emocional_mental"
                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm {{ empty($avaliacao->qual_tratamento_emocional_mental) ? 'hidden' : '' }}"
                                   placeholder="Informe qual tratamento emocional ou mental"
                                   value="{{ old('qual_tratamento_emocional_mental', $avaliacao->qual_tratamento_emocional_mental) }}">

                            @error('qual_tratamento_emocional_mental')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function toggleQualTratamentoEmocionalMental() {
                                var select = document.getElementById('tratamento_emocional_mental');
                                var input = document.getElementById('qual_tratamento_emocional_mental');

                                // Se a opção "Nenhum" (supondo que seja "1") for selecionada, oculta o campo
                                if (select.value === "" || select.value === "1") {
                                    input.classList.add('hidden');
                                    input.value = ""; // Limpa o campo quando ocultado
                                } else {
                                    input.classList.remove('hidden');
                                }
                            }

                            // Define o estado inicial ao carregar a página
                            window.onload = function() {
                                toggleQualTratamentoEmocionalMental();
                            };
                        </script>


                        <!-- Faz uso de medicação controlada? -->
                        <div class="mb-4">
                            <label for="medicacao_controlada"
                                   class="block text-sm font-medium text-gray-700">Faz uso de medicação controlada?</label>
                            <select name="medicacao_controlada" id="medicacao_controlada"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($medicacao_controlada as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ $avaliacao->medicacao_controlada == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('medicacao_controlada')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>




                        <!-- 11º Você possui alguma restrição física que possa afetar a prática de massoterapia? -->
                        <div class="mb-4">
                            <label for="restricao_fisica" class="block text-sm font-medium text-gray-700">
                                Você possui alguma restrição física que possa afetar a prática de massoterapia?
                            </label>
                            <select name="restricao_fisica" id="restricao_fisica"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualRestricaoFisica()">
                                @foreach ($restricao_fisica as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('restricao_fisica', $avaliacao->restricao_fisica) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Campo oculto para especificar a restrição física -->
                            <input type="text" name="qual_restricao_fisica" id="qual_restricao_fisica"
                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm {{ empty($avaliacao->qual_restricao_fisica) ? 'hidden' : '' }}"
                                   placeholder="Informe qual restrição física"
                                   value="{{ old('qual_restricao_fisica', $avaliacao->qual_restricao_fisica) }}">

                            @error('qual_restricao_fisica')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function toggleQualRestricaoFisica() {
                                var select = document.getElementById('restricao_fisica');
                                var input = document.getElementById('qual_restricao_fisica');

                                // Se a opção "Nenhum" (supondo que seja "1") for selecionada, oculta o campo
                                if (select.value === "" || select.value === "1") {
                                    input.classList.add('hidden');
                                    input.value = ""; // Limpa o campo quando ocultado
                                } else {
                                    input.classList.remove('hidden');
                                }
                            }

                            // Define o estado inicial ao carregar a página
                            window.onload = function() {
                                toggleQualRestricaoFisica();
                            };
                        </script>



                        <!-- 13º Possui alergia a algum tipo de óleo, creme ou substância usada em massagem? -->
                        <div class="mb-4">
                            <label for="tipo_alergia" class="block text-sm font-medium text-gray-700">
                                Possui alergia a algum tipo de óleo, creme ou substância usada em massagem?
                            </label>
                            <select name="tipo_alergia" id="tipo_alergia"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualTipoAlergia()">
                                @foreach ($tipo_alergia as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('tipo_alergia', $avaliacao->tipo_alergia) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Campo oculto para especificar o tipo de alergia -->
                            <input type="text" name="qual_tipo_alergia" id="qual_tipo_alergia"
                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm {{ empty($avaliacao->qual_tipo_alergia) ? 'hidden' : '' }}"
                                   placeholder="Informe qual substância causa alergia"
                                   value="{{ old('qual_tipo_alergia', $avaliacao->qual_tipo_alergia) }}">

                            @error('qual_tipo_alergia')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function toggleQualTipoAlergia() {
                                var select = document.getElementById('tipo_alergia');
                                var input = document.getElementById('qual_tipo_alergia');

                                // Se a opção "Nenhum" (supondo que seja "1") for selecionada, oculta o campo
                                if (select.value === "" || select.value === "1") {
                                    input.classList.add('hidden');
                                    input.value = ""; // Limpa o campo quando ocultado
                                } else {
                                    input.classList.remove('hidden');
                                }
                            }

                            // Define o estado inicial ao carregar a página
                            window.onload = function() {
                                toggleQualTipoAlergia();
                            };
                        </script>


                        <!-- 13º Nível de Estresse -->
                        <div class="mb-4">
                            <label for="nivel_estresse" class="block text-sm font-medium text-gray-700">
                                Nível de Estresse
                            </label>

                            <select name="nivel_estresse" id="nivel_estresse"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($nivel_estresse as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('nivel_estresse', $avaliacao->nivel_estresse) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            @error('nivel_estresse')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>







                        <!-- 14º Qual é o seu objetivo principal ao participar das sessões de massoterapia? -->
                        <div class="mb-4">
                            <label for="objetivo_sessoes_massoterapia" class="block text-sm font-medium text-gray-700">
                                14º Qual é o seu objetivo principal ao participar das sessões de massoterapia?
                            </label>

                            <select name="objetivo_sessoes_massoterapia" id="objetivo_sessoes_massoterapia"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualObjetivoSessoesMassoterapia()">
                                @foreach ($objetivo_sessoes_massoterapia as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('objetivo_sessoes_massoterapia', $avaliacao->objetivo_sessoes_massoterapia) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            @error('objetivo_sessoes_massoterapia')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo oculto para especificar outro objetivo -->
                        <div id="campo_outro_objetivo_sessoes_massoterapia"
                             class="{{ old('objetivo_sessoes_massoterapia', $avaliacao->objetivo_sessoes_massoterapia) == 6 ? '' : 'hidden' }}">
                            <input type="text" name="qual_objetivo_sessoes_massoterapia" id="qual_objetivo_sessoes_massoterapia"
                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                                   placeholder="Informe seu objetivo"
                                   value="{{ old('qual_objetivo_sessoes_massoterapia', $avaliacao->qual_objetivo_sessoes_massoterapia) }}">

                            @error('qual_objetivo_sessoes_massoterapia')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            function toggleQualObjetivoSessoesMassoterapia() {
                                var select = document.getElementById('objetivo_sessoes_massoterapia');
                                var campoOutro = document.getElementById('campo_outro_objetivo_sessoes_massoterapia');
                                var inputOutro = document.getElementById('qual_objetivo_sessoes_massoterapia');

                                // Converte o valor selecionado para inteiro para evitar comparação errada
                                var selectedValue = parseInt(select.value, 10);

                                console.log("Valor selecionado:", selectedValue); // Debug no console

                                if (selectedValue === 6) {
                                    campoOutro.classList.remove('hidden');
                                } else {
                                    campoOutro.classList.add('hidden');
                                    inputOutro.value = ""; // Limpa o campo quando ocultado
                                }
                            }

                            // Aguarda o carregamento da página para definir corretamente o estado inicial
                            document.addEventListener("DOMContentLoaded", function () {
                                toggleQualObjetivoSessoesMassoterapia();
                            });
                        </script>





                        <!-- 19º Grupo Étnico -->
                        <div class="mb-4">
                            <label for="grupo_etnico" class="block text-sm font-medium text-gray-700">
                                Grupo Étnico
                            </label>

                            <select name="grupo_etnico" id="grupo_etnico"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualGrupoEtnico()">
                                @foreach ($grupo_etnico as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('grupo_etnico', $avaliacao->grupo_etnico) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            @error('grupo_etnico')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo oculto para especificar o grupo étnico -->
                        <input type="text" name="qual_grupo_etnico" id="qual_grupo_etnico"
                               class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"
                               placeholder="Informe qual grupo étnico"
                               value="{{ old('qual_grupo_etnico', $avaliacao->qual_grupo_etnico) }}">

                        @error('qual_grupo_etnico')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror

                        <script>
                            function toggleQualGrupoEtnico() {
                                var select = document.getElementById('grupo_etnico');
                                var input = document.getElementById('qual_grupo_etnico');

                                // Supondo que "Outro" seja a última opção no banco de dados
                                if (select.value === "6") {
                                    input.classList.remove('hidden');
                                } else {
                                    input.classList.add('hidden');
                                    input.value = ""; // Limpa o campo quando ocultado
                                }
                            }

                            // Define o estado inicial ao carregar a página
                            window.onload = function() {
                                toggleQualGrupoEtnico();
                            };
                        </script>




                        <!-- 18º Orientação Sexual-->
                        <div class="mb-4">
                            <label for="orientacao_sexual" class="block text-sm font-medium text-gray-700">Orientação Sexual</label>
                            <select name="orientacao_sexual" id="orientacao_sexual" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($orientacao_sexual as $orientacao)
                                    <option value="{{ $orientacao->id }}"
                                        {{ $avaliacao->orientacao_sexual == $orientacao->id ? 'selected' : '' }}>
                                        {{ $orientacao->valor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('orientacao_sexual')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 19º Grupo Étnico -->
                        <div class="mb-4">
                            <label for="grupo_etnico" class="block text-sm font-medium text-gray-700">
                                Grupo Étnico
                            </label>

                            <select name="grupo_etnico" id="grupo_etnico"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    onchange="toggleQualGrupoEtnico()">
                                @foreach ($grupo_etnico as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('grupo_etnico', $avaliacao->grupo_etnico) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            @error('grupo_etnico')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo oculto para especificar o grupo étnico -->
                        <input type="text" name="qual_grupo_etnico" id="qual_grupo_etnico"
                               class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"
                               placeholder="Informe qual grupo étnico"
                               value="{{ old('qual_grupo_etnico', $avaliacao->qual_grupo_etnico) }}">

                        @error('qual_grupo_etnico')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror

                        <script>
                            function toggleQualGrupoEtnico() {
                                var select = document.getElementById('grupo_etnico');
                                var input = document.getElementById('qual_grupo_etnico');

                                // Supondo que "Outro" seja a última opção no banco de dados
                                if (select.value === "6") {
                                    input.classList.remove('hidden');
                                } else {
                                    input.classList.add('hidden');
                                    input.value = ""; // Limpa o campo quando ocultado
                                }
                            }

                            // Define o estado inicial ao carregar a página
                            window.onload = function() {
                                toggleQualGrupoEtnico();
                            };
                        </script>


                        <!-- 21º Cor de acordo com os critério do IBGE? -->
                        <div class="mb-4">
                            <label for="cor_pele" class="block text-sm font-medium text-gray-700">
                                Cor de acordo com os critério do IBGE?
                            </label>

                            <select name="cor_pele" id="cor_pele"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($cor_pele as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ old('cor_pele', $avaliacao->cor_pele) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>

                            @error('cor_pele')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- 22º Você autoriza a realização de registros fotográficos para fins de divulgação do projeto (sempre respeitando o direito de imagem) -->
                        <div class="mb-4">
                            <label for="registro_fotografico"
                                   class="block text-sm font-medium text-gray-700">Você autoriza a realização de registros fotográficos para fins de divulgação do projeto (sempre respeitando o
                                direito de imagem)?</label>
                            <select name="registro_fotografico" id="registro_fotografico"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($registro_fotografico as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ $avaliacao->registro_fotografico == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->valor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('registro_fotografico')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>






                        <!-- Gostaria de fazer alguma observação adicional sobre sua saúde física ou emocional? -->
                        <div class="mb-4">
                            <label for="obs_adicional_saude" class="block text-sm font-medium text-gray-700">
                                Gostaria de fazer alguma observação adicional sobre sua saúde física ou emocional?
                            </label>
                            <textarea name="obs_adicional_saude" id="obs_adicional_saude"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                      placeholder="Digite aqui suas observações adicionais sobre sua saúde física ou emocional">{{ old('obs_adicional_saude', $avaliacao->obs_adicional_saude) }}</textarea>

                            @error('obs_adicional_saude')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>





                        <!-- Outros campos da avaliação -->
{{--                        <div class="mb-4">--}}
{{--                            <label for="user_id" class="block text-sm font-medium text-gray-700">ID do Usuário</label>--}}
{{--                            <input type="text" name="user_id" id="user_id" value="{{ old('user_id', $avaliacao->user_id) }}"--}}
{{--                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                            @error('user_id')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-green-500 #8066f7 text-white rounded-md shadow hover:bg-green-600">
                                Salvar Avaliação
                            </button>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
