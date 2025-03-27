<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Avaliação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Exibição de erro -->
                    @if(session('error'))
                        <div class="alert alert-danger mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('avaliacoes.store') }}" method="POST">
                        @csrf


                        <form method="POST" action="{{ route('avaliacoes.store') }}"
                              class="p-6 bg-white rounded-lg shadow-md">
                            @csrf

                            <div class="space-y-6 mt-4">

                                <!-- 1º Você já participou de sessões de massoterapia anteriormente? -->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label for="sessoes_massoterapia_anteriormente"
                                           class="block text-sm font-medium text-gray-900">
                                        Você já participou de sessões de massoterapia anteriormente?
                                    </label>
                                    <div class="mt-2 flex space-x-6">
                                        @foreach ($sessoes_massoterapia_anteriormente as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="sessoes_massoterapia_anteriormente"
                                                       id="sessoes_massoterapia_{{ $grupo->id }}"
                                                       value="{{ $grupo->id }}"
                                                       class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                    {{ old('sessoes_massoterapia_anteriormente') == $grupo->id ? 'checked' : '' }}>
                                                <label for="sessoes_massoterapia_{{ $grupo->id }}"
                                                       class="ml-2 text-sm text-gray-700">
                                                    {{ $grupo->valor }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('sessoes_massoterapia_anteriormente')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- 2º Você possui alguma condição médica diagnosticada? -->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Você possui alguma condição médica diagnosticada?
                                    </label>
                                    <div class="mt-2 flex items-center space-x-6">
                                        <div class="flex items-center">
                                            <input type="radio" name="condicao_medica_diagnosticada" value="1"
                                                   class="form-radio h-4 w-4 text-indigo-600"
                                                {{ old('condicao_medica_diagnosticada') == '1' ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-700">Não</span>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="condicao_medica_diagnosticada" value="2"
                                                   class="form-radio h-4 w-4 text-indigo-600"
                                                {{ old('condicao_medica_diagnosticada') == '2' ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-700">Sim</span>
                                        </div>
                                    </div>
                                    <input type="text" name="qual_condicao_medica_diagnosticada" id="qual_diagnostico"
                                           class="mt-2 block w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm hidden"
                                           placeholder="Informe qual condição médica diagnosticada">
                                    @error('qual_condicao_medica_diagnosticada')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const radioButtons = document.getElementsByName("condicao_medica_diagnosticada");
                                        const inputQualDiagnostico = document.getElementById("qual_diagnostico");

                                        radioButtons.forEach(function (radio) {
                                            radio.addEventListener("change", function () {
                                                if (this.value === "2") {
                                                    inputQualDiagnostico.classList.remove("hidden");
                                                    inputQualDiagnostico.setAttribute("required", "required");
                                                } else {
                                                    inputQualDiagnostico.classList.add("hidden");
                                                    inputQualDiagnostico.removeAttribute("required");
                                                    inputQualDiagnostico.value = "";
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <!-- 3º Histórico de problemas de saúde física -->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label for="problema_saude_fisica" class="block text-sm font-medium text-gray-700">
                                        Histórico de problemas de saúde física (ex.: hipertensão, diabetes, problemas
                                        respiratórios)
                                    </label>
                                    <div class="mt-1 flex space-x-6">
                                        @foreach ($problema_saude_fisica as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="problema_saude_fisica"
                                                       id="problema_saude_{{ $grupo->id }}" value="{{ $grupo->id }}"
                                                       class="mr-2 border-gray-300 rounded-md shadow-sm" {{ old('problema_saude_fisica') == $grupo->id ? 'checked' : '' }}>
                                                <label for="problema_saude_{{ $grupo->id }}"
                                                       class="text-sm text-gray-700">
                                                    {{ $grupo->valor }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <input type="text" name="qual_problema_saude_fisica" id="qual_problema_fisico"
                                           class="mt-2 block w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm hidden"
                                           placeholder="Informe qual problema de saúde física">

                                    @error('qual_problema_saude_fisica')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const radiosProblemaSaude = document.querySelectorAll('input[name="problema_saude_fisica"]');
                                        const inputQualProblema = document.getElementById("qual_problema_fisico");

                                        radiosProblemaSaude.forEach(function (radio) {
                                            radio.addEventListener("change", function () {
                                                if (this.value === "2") {
                                                    inputQualProblema.classList.remove("hidden");
                                                    inputQualProblema.setAttribute("required", "required");
                                                } else {
                                                    inputQualProblema.classList.add("hidden");
                                                    inputQualProblema.removeAttribute("required");
                                                    inputQualProblema.value = "";
                                                }
                                            });
                                        });
                                    });
                                </script>


                                <!-- 4º Histórico de problemas de saúde emocional-->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label for="problema_saude_emocional"
                                           class="block text-sm font-medium text-gray-700">
                                        4º Histórico de problemas de saúde emocional?
                                    </label>
                                    <div class="mt-2 flex space-x-6">
                                        @foreach ($problema_saude_emocional as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="problema_saude_emocional"
                                                       id="problema_saude_{{ $grupo->id }}"
                                                       value="{{ $grupo->id }}"
                                                       class="mr-2 border-gray-300 rounded-md shadow-sm"
                                                    {{ old('problema_saude_emocional') == $grupo->id ? 'checked' : '' }}>
                                                <label for="problema_saude_{{ $grupo->id }}"
                                                       class="text-sm text-gray-700">
                                                    {{ $grupo->valor }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div id="checkbox-container" class="mt-2 hidden">
                                        <label class="block text-sm font-medium text-gray-700">Selecione as
                                            doenças</label>
                                        <div class="space-y-2">
                                            @foreach ($doenca as $do)
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="doencas[]" value="{{ $do->id }}"
                                                           class="doenca-checkbox">
                                                    <label class="text-sm text-gray-700">{{ $do->valor }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <input type="text" name="qual_problema_saude_emocional" id="qual_problema_emocional"
                                           class="mt-2 block w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm hidden"
                                           placeholder="Informe qual problema de saúde emocional">

                                    @error('qual_problema_saude_emocional')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const radios = document.querySelectorAll('input[name="problema_saude_emocional"]');
                                        const checkboxContainer = document.getElementById('checkbox-container');
                                        const qualProblemaInput = document.getElementById('qual_problema_emocional');

// Função para mostrar ou ocultar o container de checkboxes e o campo de texto
                                        function toggleCheckboxes() {
                                            const radioSelecionado = document.querySelector('input[name="problema_saude_emocional"]:checked');
                                            if (radioSelecionado && radioSelecionado.value == "2") { // valor 2 seria para a opção que mostra as doenças
                                                checkboxContainer.classList.remove('hidden');
                                                qualProblemaInput.classList.add('hidden'); // Oculta o campo de texto inicialmente
                                            } else {
                                                checkboxContainer.classList.add('hidden');
                                                qualProblemaInput.classList.add('hidden');
                                            }
                                        }

                // Função para mostrar ou ocultar o campo de texto baseado no checkbox selecionado
                                        function toggleTextField() {
                                            const checkboxSeis = document.querySelector('input[name="doencas[]"][value="6"]');
                                            if (checkboxSeis && checkboxSeis.checked) {
                                                qualProblemaInput.classList.remove('hidden');
                                            } else {
                                                qualProblemaInput.classList.add('hidden');
                                            }
                                        }

                                        // Eventos
                                        radios.forEach(function (radio) {
                                            radio.addEventListener('change', toggleCheckboxes);
                                        });

                                        // Para os checkboxes, também ouvimos o evento 'change' para mostrar ou ocultar o campo de texto
                                        const checkboxes = document.querySelectorAll('.doenca-checkbox');
                                        checkboxes.forEach(function (checkbox) {
                                            checkbox.addEventListener('change', toggleTextField);
                                        });
                                        // Executar a lógica inicial
                                        toggleCheckboxes();
                                        toggleTextField();
                                    });
                                </script>


                                <!-- 8ºEstá atualmente em tratamento para alguma condição emocional ou mental?-->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label class="block text-sm font-medium text-gray-700">
                                        5º Está atualmente em tratamento para alguma condição emocional ou mental?
                                    </label>
                                    <div class="mt-2 flex items-center space-x-6">
                                        @foreach ($tratamento_emocional_mental as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="tratamento_emocional_mental"
                                                       id="tratamento_emocional_{{ $grupo->id }}"
                                                       value="{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('tratamento_emocional_mental') == $grupo->id ? 'checked' : '' }}>
                                                <span class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Campo oculto para especificar qual tratamento -->
                                    <input type="text" name="qual_tratamento_emocional_mental"
                                           id="qual_tratamento_emocional_mental"
                                           class="mt-2 block w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm hidden"
                                           placeholder="Informe qual tratamento emocional ou mental">

                                    @error('qual_tratamento_emocional_mental')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const radioButtons = document.getElementsByName("tratamento_emocional_mental");
                                        const inputQualTratamento = document.getElementById("qual_tratamento_emocional_mental");

                                        radioButtons.forEach(function (radio) {
                                            radio.addEventListener("change", function () {
                                                if (this.value === "2") {
                                                    inputQualTratamento.classList.remove("hidden");
                                                    inputQualTratamento.setAttribute("required", "required");
                                                } else {
                                                    inputQualTratamento.classList.add("hidden");
                                                    inputQualTratamento.removeAttribute("required");
                                                    inputQualTratamento.value = "";
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <!-- 8º Está atualmente em tratamento para alguma condição emocional ou mental?-->
                                {{--                                <div class="mb-4">--}}
                                {{--                                    <label for="tratamento_emocional_mental" class="block text-sm font-medium text-gray-700">--}}
                                {{--                                        Está atualmente em tratamento para alguma condição emocional ou mental?--}}
                                {{--                                    </label>--}}
                                {{--                                    <select name="tratamento_emocional_mental" id="tratamento_emocional_mental"--}}
                                {{--                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
                                {{--                                        <option value="">Selecione</option>--}}
                                {{--                                        @foreach ($tratamento_emocional_mental as $grupo)--}}
                                {{--                                            <option value="{{ $grupo->id }}" {{ old('tratamento_emocional_mental') == $grupo->id ? 'selected' : '' }}>--}}
                                {{--                                                {{ $grupo->valor }}--}}
                                {{--                                            </option>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </select>--}}

                                {{--                                    <input type="text" name="qual_tratamento_emocional_mental" id="qual_tratamento_emocional_mental"--}}
                                {{--                                           class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"--}}
                                {{--                                           placeholder="Informe qual tratamento emocional ou mental">--}}

                                {{--                                    @error('qual_tratamento_emocional_mental')--}}
                                {{--                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}

                                {{--                                <script>--}}
                                {{--                                    document.addEventListener('DOMContentLoaded', function () {--}}
                                {{--                                        const selectTratamento = document.getElementById('tratamento_emocional_mental');--}}
                                {{--                                        const inputQualTratamento = document.getElementById('qual_tratamento_emocional_mental');--}}

                                {{--                                        // Função para mostrar ou ocultar o campo de texto--}}
                                {{--                                        function toggleTextField() {--}}
                                {{--                                            if (selectTratamento.value === "2") {--}}
                                {{--                                                inputQualTratamento.classList.remove('hidden');--}}
                                {{--                                            } else {--}}
                                {{--                                                inputQualTratamento.classList.add('hidden');--}}
                                {{--                                            }--}}
                                {{--                                        }--}}

                                {{--                                        // Evento de mudança no select--}}
                                {{--                                        selectTratamento.addEventListener('change', toggleTextField);--}}

                                {{--                                        // Executar a lógica inicial caso haja valores preenchidos--}}
                                {{--                                        toggleTextField();--}}
                                {{--                                    });--}}
                                {{--                                </script>--}}
                                {{--                            </div>--}}

                                <!-- Faz uso de medicação controlada? -->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Faz uso de medicação controlada?
                                    </label>
                                    <div class="mt-2 flex items-center space-x-6">
                                        @foreach ($medicacao_controlada as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="medicacao_controlada"
                                                       id="medicacao_controlada_{{ $grupo->id }}"
                                                       value="{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('medicacao_controlada') == $grupo->id ? 'checked' : '' }}>
                                                <span class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('medicacao_controlada')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- 11º Você possui alguma restrição física que possa afetar a prática de massoterapia?-->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Você possui alguma restrição física que possa afetar a prática de massoterapia?
                                    </label>
                                    <div class="mt-2 flex items-center space-x-6">
                                        @foreach ($restricao_fisica as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="restricao_fisica"
                                                       id="restricao_fisica_{{ $grupo->id }}"
                                                       value="{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('restricao_fisica') == $grupo->id ? 'checked' : '' }}>
                                                <span class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Campo oculto para especificar qual restrição física -->
                                    <input type="text" name="qual_restricao_fisica" id="qual_restricao_fisica"
                                           class="mt-2 block w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm hidden"
                                           placeholder="Informe qual restrição física">

                                    @error('qual_restricao_fisica')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const radioButtons = document.getElementsByName("restricao_fisica");
                                        const inputQualRestricao = document.getElementById("qual_restricao_fisica");

                                        radioButtons.forEach(function (radio) {
                                            radio.addEventListener("change", function () {
                                                if (this.value === "2") {
                                                    inputQualRestricao.classList.remove("hidden");
                                                    inputQualRestricao.setAttribute("required", "required");
                                                } else {
                                                    inputQualRestricao.classList.add("hidden");
                                                    inputQualRestricao.removeAttribute("required");
                                                    inputQualRestricao.value = "";
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <!-- 13º Possui alergia a algum tipo de óleo, creme ou substância usada em massagem?-->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Possui alergia a algum tipo de óleo, creme ou substância usada em massagem?
                                    </label>
                                    <div class="mt-2 flex items-center space-x-6">
                                        @foreach ($tipo_alergia as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="tipo_alergia"
                                                       id="tipo_alergia_{{ $grupo->id }}"
                                                       value="{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('tipo_alergia') == $grupo->id ? 'checked' : '' }}>
                                                <span class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Campo oculto para especificar qual alergia -->
                                    <input type="text" name="qual_tipo_alergia" id="qual_tipo_alergia"
                                           class="mt-2 block w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm hidden"
                                           placeholder="Informe qual alergia">

                                    @error('qual_tipo_alergia')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const radioButtons = document.getElementsByName("tipo_alergia");
                                        const inputQualAlergia = document.getElementById("qual_tipo_alergia");

                                        radioButtons.forEach(function (radio) {
                                            radio.addEventListener("change", function () {
                                                if (this.value === "2") {
                                                    inputQualAlergia.classList.remove("hidden");
                                                    inputQualAlergia.setAttribute("required", "required");
                                                } else {
                                                    inputQualAlergia.classList.add("hidden");
                                                    inputQualAlergia.removeAttribute("required");
                                                    inputQualAlergia.value = "";
                                                }
                                            });
                                        });
                                    });
                                </script>


                                <!-- 13ºNível de Estresse?-->
                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label for="nivel_estresse" class="block text-sm font-medium text-gray-700">
                                        Nível de Estresse
                                    </label>
                                    <div class="mt-2 flex space-x-6">
                                        @foreach ($nivel_estresse as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="nivel_estresse"
                                                       id="nivel_estresse_{{ $grupo->id }}"
                                                       value="{{ $grupo->id }}"
                                                       class="mr-2 border-gray-300 rounded-md shadow-sm"
                                                    {{ old('nivel_estresse') == $grupo->id ? 'checked' : '' }}>
                                                <label for="nivel_estresse_{{ $grupo->id }}"
                                                       class="text-sm text-gray-700">
                                                    {{ $grupo->valor }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('nivel_estresse')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="bg-white p-4 rounded-md shadow-md">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Qual é o seu objetivo principal ao participar das sessões de massoterapia?
                                    </label>
                                    <div class="mt-2 space-y-2">
                                        @foreach ($objetivo_sessoes_massoterapia as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="objetivo_sessoes_massoterapia"
                                                       value="{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('objetivo_sessoes_massoterapia') == $grupo->id ? 'checked' : '' }}>
                                                <span class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</span>
                                            </div>
                                        @endforeach
                                        <div class="flex items-center">
                                        </div>
                                    </div>

                                    <input type="text" name="qual_objetivo_sessoes_massoterapia"
                                           id="qual_objetivo_sessoes_massoterapia"
                                           class="mt-2 block w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm hidden"
                                           placeholder="Informe seu objetivo">

                                    @error('qual_objetivo_sessoes_massoterapia')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const radioButtons = document.getElementsByName("objetivo_sessoes_massoterapia");
                                        const inputQualObjetivo = document.getElementById("qual_objetivo_sessoes_massoterapia");

                                        radioButtons.forEach(function (radio) {
                                            radio.addEventListener("change", function () {
                                                if (this.value === "6") {
                                                    inputQualObjetivo.classList.remove("hidden");
                                                    inputQualObjetivo.setAttribute("required", "required");
                                                } else {
                                                    inputQualObjetivo.classList.add("hidden");
                                                    inputQualObjetivo.removeAttribute("required");
                                                    inputQualObjetivo.value = "";
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <!-- 18º Orientação Sexual-->
                                <div class="mb-4">
                                    <label for="orientacao_sexual" class="block text-sm font-medium text-gray-700">Orientação
                                        Sexual</label>
                                    <div class="mt-2 space-y-2">
                                        @foreach ($orientacao_sexual as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="orientacao_sexual" value="{{ $grupo->id }}"
                                                       id="orientacao_{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('orientacao_sexual') == $grupo->id ? 'checked' : '' }}>
                                                <label for="orientacao_{{ $grupo->id }}"
                                                       class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('orientacao_sexual')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- 19º Grupo Étnico -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Grupo Étnico</label>
                                    <div class="mt-2 space-y-2">
                                        @foreach ($grupo_etnicos as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="grupo_etnico" value="{{ $grupo->id }}"
                                                       id="grupo_etnico_{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('grupo_etnico') == $grupo->id ? 'checked' : '' }}>
                                                <label for="grupo_etnico_{{ $grupo->id }}"
                                                       class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <input type="text" name="qual_grupo_etnico" id="qual_etnico"
                                           class="mt-2 block w-full sm:w-1/2 border-gray-300 rounded-md shadow-sm hidden"
                                           placeholder="Informe qual grupo étnico">

                                    @error('qual_grupo_etnico')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const radioButtons = document.getElementsByName("grupo_etnico");
                                        const inputQualEtnico = document.getElementById("qual_etnico");

                                        radioButtons.forEach(function (radio) {
                                            radio.addEventListener("change", function () {
                                                // Verificar se a última opção foi selecionada (último grupo)
                                                if (this.value === "6") {  // Substitua "6" pelo ID do seu grupo específico
                                                    inputQualEtnico.classList.remove("hidden");
                                                    inputQualEtnico.setAttribute("required", "required");
                                                } else {
                                                    inputQualEtnico.classList.add("hidden");
                                                    inputQualEtnico.removeAttribute("required");
                                                    inputQualEtnico.value = "";
                                                }
                                            });
                                        });
                                    });
                                </script>


                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Cor de acordo com os critério
                                        do IBGE?</label>
                                    <div class="mt-2 flex space-x-6">
                                        @foreach ($cor_pele as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="cor_pele" value="{{ $grupo->id }}"
                                                       id="cor_pele_{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('cor_pele') == $grupo->id ? 'checked' : '' }}>
                                                <label for="cor_pele_{{ $grupo->id }}"
                                                       class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('cor_pele')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- 22º Você autoriza a realização de registros fotográficos para fins de divulgação do projeto (sempre respeitando o direito de imagem) -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Você autoriza a realização de
                                        registros fotográficos para fins de divulgação do projeto (sempre respeitando o
                                        direito de imagem)?</label>
                                    <div class="mt-2 flex space-x-6">
                                        @foreach ($registro_fotografico as $grupo)
                                            <div class="flex items-center">
                                                <input type="radio" name="registro_fotografico" value="{{ $grupo->id }}"
                                                       id="registro_fotografico_{{ $grupo->id }}"
                                                       class="form-radio h-4 w-4 text-indigo-600"
                                                    {{ old('registro_fotografico') == $grupo->id ? 'checked' : '' }}>
                                                <label for="registro_fotografico_{{ $grupo->id }}"
                                                       class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @error('registro_fotografico')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Gostaria de fazer alguma observação adicional sobre sua saúde física ou emocional?-->
                                <div class="mb-4">
                                    <label for="obs_adicional_saude" class="block text-sm font-medium text-gray-700">
                                        Gostaria de fazer alguma observação adicional sobre sua saúde física ou
                                        emocional?
                                    </label>
                                    <textarea name="obs_adicional_saude" id="obs_adicional_saude"
                                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                              placeholder="Digite aqui suas observações adicionais sobre sua saúde física ou emocional"></textarea>


                                    @error('obs_adicional_saude')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Botões -->
                                <div class="flex justify-between mt-6">
                                    <button type="button"
                                            onclick="window.location.href='{{ route('avaliacoes.index') }}'"
                                            class="px-4 py-2 bg-gray-500 text-white rounded-md">Voltar
                                    </button>
                                    <button type="submit"
                                            class="px-4 py-2 bg-[#17736D] text-white rounded-lg hover:bg-[#155D59] shadow focus:outline-none focus:ring-4 focus:ring-[#1A8D86] transition-all duration-300 ease-in-out transform hover:scale-105">
                                        Salvar
                                    </button>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


{{--                        <div class="mb-4 flex space-x-4">--}}
{{--                            <!-- 1º Você já participou de sessões de massoterapia anteriormente? -->--}}
{{--                            <div class="flex-1">--}}
{{--                                <label for="sessoes_massoterapia_anteriormente"--}}
{{--                                       class="block text-sm font-medium text-gray-700">Você já participou de sessões de massoterapia anteriormente?</label>--}}
{{--                                <select name="sessoes_massoterapia_anteriormente" id="sessoes_massoterapia_anteriormente"--}}
{{--                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                    <option value="">Selecione</option>--}}
{{--                                    @foreach ($sessoes_massoterapia_anteriormente as $grupo)--}}
{{--                                        <option value="{{ $grupo->id }}" {{ old('sessoes_massoterapia_anteriormente') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                            {{ $grupo->valor }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('sessoes_massoterapia_anteriormente')--}}
{{--                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            <!-- 2º Você possui alguma condição médica diagnosticada? -->--}}
{{--                            <div class="flex-1">--}}
{{--                                <label for="condicao_medica_diagnosticada" class="block text-sm font-medium text-gray-700">--}}
{{--                                    Você possui alguma condição médica diagnosticada?--}}
{{--                                </label>--}}
{{--                                <select name="condicao_medica_diagnosticada" id="condicao_medica_diagnosticada"--}}
{{--                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                    <option value="">Selecione</option>--}}
{{--                                    @foreach ($condicao_medica_diagnosticada as $grupo)--}}
{{--                                        <option value="{{ $grupo->id }}" {{ old('condicao_medica_diagnosticada') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                            {{ $grupo->valor }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                <!-- Campo oculto para informar qual condição médica diagnosticada -->--}}
{{--                                <input type="text" name="qual_condicao_medica_diagnosticada" id="qual_diagnostico"--}}
{{--                                       class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"--}}
{{--                                       placeholder="Informe qual condição médica diagnosticada">--}}
{{--                                @error('qual_condicao_medica_diagnosticada')--}}
{{--                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <script>--}}
{{--                            document.addEventListener("DOMContentLoaded", function () {--}}
{{--                                const selectCondicao = document.getElementById("condicao_medica_diagnosticada");--}}
{{--                                const inputQualDiagnostico = document.getElementById("qual_diagnostico");--}}

{{--                                selectCondicao.addEventListener("change", function () {--}}
{{--                                    if (this.value === "2") {--}}
{{--                                        inputQualDiagnostico.classList.remove("hidden");--}}
{{--                                        inputQualDiagnostico.setAttribute("required", "required"); // Torna o campo obrigatório--}}
{{--                                    } else {--}}
{{--                                        inputQualDiagnostico.classList.add("hidden");--}}
{{--                                        inputQualDiagnostico.removeAttribute("required"); // Remove a obrigatoriedade caso não seja necessário--}}
{{--                                        inputQualDiagnostico.value = ""; // Limpa o campo ao ocultar--}}
{{--                                    }--}}
{{--                                });--}}
{{--                            });--}}
{{--                        </script>--}}


{{--                        <!-- 3º Histórico de problemas de saúde física (ex.: hipertensão, diabetes, problemas respiratórios) -->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="problema_saude_fisica" class="block text-sm font-medium text-gray-700">--}}
{{--                                3º  Histórico de problemas de saúde física (ex.: hipertensão, diabetes, problemas respiratórios)--}}
{{--                            </label>--}}
{{--                            <select name="problema_saude_fisica" id="problema_saude_fisica"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($problema_saude_fisica as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('problema_saude_fisica') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}


{{--                            <!-- Campo oculto para especificar o problema de saúde -->--}}
{{--                            <input type="text" name="qual_problema_saude_fisica" id="qual_problema_fisico"--}}
{{--                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"--}}
{{--                                   placeholder="Informe qual problema de saúde física">--}}


{{--                            @error('qual_problema_saude_fisica')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <script>--}}
{{--                            document.addEventListener("DOMContentLoaded", function () {--}}
{{--                                const selectProblemaSaude = document.getElementById("problema_saude_fisica");--}}
{{--                                const inputQualProblema = document.getElementById("qual_problema_fisico");--}}


{{--                                selectProblemaSaude.addEventListener("change", function () {--}}
{{--                                    if (this.value === "2") {--}}
{{--                                        inputQualProblema.classList.remove("hidden");--}}
{{--                                        inputQualProblema.setAttribute("required", "required"); // Torna o campo obrigatório--}}
{{--                                    } else {--}}
{{--                                        inputQualProblema.classList.add("hidden");--}}
{{--                                        inputQualProblema.removeAttribute("required"); // Remove a obrigatoriedade caso não seja necessário--}}
{{--                                        inputQualProblema.value = ""; // Limpa o campo ao ocultar--}}
{{--                                    }--}}
{{--                                });--}}
{{--                            });--}}
{{--                        </script>--}}

{{--                        <!--4º Histórico de problemas de saúde emocional? -->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="problema_saude_emocional" class="block text-sm font-medium text-gray-700">--}}
{{--                                4º Histórico de problemas de saúde emocional?--}}
{{--                            </label>--}}
{{--                            <select name="problema_saude_emocional" id="problema_saude_emocional"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($problema_saude_emocional as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('problema_saude_emocional') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}


{{--                            <div id="checkbox-container" class="mt-2 hidden">--}}
{{--                                @foreach ($doenca as $do)--}}
{{--                                    <label>--}}
{{--                                        <input type="checkbox" name="doencas[]" value="{{ $do->id }}" class="doenca-checkbox">--}}
{{--                                        {{ $do->valor }}--}}
{{--                                    </label><br>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}


{{--                            <!-- Campo oculto para especificar o problema de saúde emocional -->--}}
{{--                            <input type="text" name="qual_problema_saude_emocional" id="qual_problema_emocional"--}}
{{--                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"--}}
{{--                                   placeholder="Informe qual problema de saúde emocional">--}}


{{--                            @error('qual_problema_saude_emocional')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <script>--}}
{{--                            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                                const selectProblema = document.getElementById('problema_saude_emocional');--}}
{{--                                const checkboxContainer = document.getElementById('checkbox-container');--}}
{{--                                const checkboxes = document.querySelectorAll('.doenca-checkbox');--}}
{{--                                const qualProblemaInput = document.getElementById('qual_problema_emocional');--}}


{{--                                // Função para mostrar ou ocultar os checkboxes--}}
{{--                                function toggleCheckboxes() {--}}
{{--                                    if (selectProblema.value === "2") {--}}
{{--                                        checkboxContainer.classList.remove('hidden');--}}
{{--                                    } else {--}}
{{--                                        checkboxContainer.classList.add('hidden');--}}
{{--                                        qualProblemaInput.classList.add('hidden'); // Oculta o campo de texto ao mudar de opção--}}
{{--                                    }--}}
{{--                                }--}}


{{--                                // Função para mostrar ou ocultar o campo de texto baseado no checkbox selecionado--}}
{{--                                function toggleTextField() {--}}
{{--                                    const checkboxSeis = [...checkboxes].find(checkbox => checkbox.value === "6");--}}
{{--                                    if (checkboxSeis && checkboxSeis.checked) {--}}
{{--                                        qualProblemaInput.classList.remove('hidden');--}}
{{--                                    } else {--}}
{{--                                        qualProblemaInput.classList.add('hidden');--}}
{{--                                    }--}}
{{--                                }--}}


{{--                                // Eventos--}}
{{--                                selectProblema.addEventListener('change', toggleCheckboxes);--}}
{{--                                checkboxes.forEach(checkbox => {--}}
{{--                                    checkbox.addEventListener('change', toggleTextField);--}}
{{--                                });--}}


{{--                                // Executar a lógica inicial caso haja valores preenchidos--}}
{{--                                toggleCheckboxes();--}}
{{--                                toggleTextField();--}}
{{--                            });--}}
{{--                        </script>--}}


{{--                        <!-- 8º Está atualmente em tratamento para alguma condição emocional ou mental?-->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="tratamento_emocional_mental" class="block text-sm font-medium text-gray-700">--}}
{{--                                5º Está atualmente em tratamento para alguma condição emocional ou mental?--}}
{{--                            </label>--}}
{{--                            <select name="tratamento_emocional_mental" id="tratamento_emocional_mental"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($tratamento_emocional_mental as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('tratamento_emocional_mental') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}


{{--                            <!-- Campo oculto para especificar qual tratamento -->--}}
{{--                            <input type="text" name="qual_tratamento_emocional_mental" id="qual_tratamento_emocional_mental"--}}
{{--                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"--}}
{{--                                   placeholder="Informe qual tratamento emocional ou mental">--}}


{{--                            @error('qual_tratamento_emocional_mental')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <script>--}}
{{--                            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                                const selectTratamento = document.getElementById('tratamento_emocional_mental');--}}
{{--                                const inputQualTratamento = document.getElementById('qual_tratamento_emocional_mental');--}}


{{--                                // Função para mostrar ou ocultar o campo de texto--}}
{{--                                function toggleTextField() {--}}
{{--                                    if (selectTratamento.value === "2") {--}}
{{--                                        inputQualTratamento.classList.remove('hidden');--}}
{{--                                    } else {--}}
{{--                                        inputQualTratamento.classList.add('hidden');--}}
{{--                                    }--}}
{{--                                }--}}
{{--                                // Evento de mudança no select--}}
{{--                                selectTratamento.addEventListener('change', toggleTextField);--}}


{{--                                // Executar a lógica inicial caso haja valores preenchidos--}}
{{--                                toggleTextField();--}}
{{--                            });--}}
{{--                        </script>--}}


{{--                        <!--10º Faz uso de medicação controlada? -->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="medicacao_controlada" class="block text-sm font-medium text-gray-700">Faz uso de--}}
{{--                                medicação controlada?</label>--}}
{{--                            <select name="medicacao_controlada" id="medicacao_controlada"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($medicacao_controlada as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('cor_pele') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('medicacao_controlada')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <!-- 11º Você possui alguma restrição física que possa afetar a prática de massoterapia?-->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="restricao_fisica" class="block text-sm font-medium text-gray-700">--}}
{{--                                Você possui alguma restrição física que possa afetar a prática de massoterapia?--}}
{{--                            </label>--}}
{{--                            <select name="restricao_fisica" id="restricao_fisica"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($restricao_fisica as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('restricao_fisica') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}


{{--                            <!-- Campo oculto para especificar qual restrição física -->--}}
{{--                            <input type="text" name="qual_restricao_fisica" id="qual_restricao_fisica"--}}
{{--                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"--}}
{{--                                   placeholder="Informe qual restrição física">--}}


{{--                            @error('qual_restricao_fisica')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <script>--}}
{{--                            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                                const selectRestricao = document.getElementById('restricao_fisica');--}}
{{--                                const inputQualRestricao = document.getElementById('qual_restricao_fisica');--}}


{{--                                // Função para mostrar ou ocultar o campo de texto--}}
{{--                                function toggleTextField() {--}}
{{--                                    if (selectRestricao.value === "2") {--}}
{{--                                        inputQualRestricao.classList.remove('hidden');--}}
{{--                                    } else {--}}
{{--                                        inputQualRestricao.classList.add('hidden');--}}
{{--                                    }--}}
{{--                                }--}}


{{--                                // Evento de mudança no select--}}
{{--                                selectRestricao.addEventListener('change', toggleTextField);--}}


{{--                                // Executar a lógica inicial caso haja valores preenchidos--}}
{{--                                toggleTextField();--}}
{{--                            });--}}
{{--                        </script>--}}


{{--                        <!-- 13º Possui alergia a algum tipo de óleo, creme ou substância usada em massagem?-->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="tipo_alergia" class="block text-sm font-medium text-gray-700">--}}
{{--                                Possui alergia a algum tipo de óleo, creme ou substância usada em massagem?--}}
{{--                            </label>--}}
{{--                            <select name="tipo_alergia" id="tipo_alergia"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($tipo_alergia as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('tipo_alergia') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}


{{--                            <!-- Campo oculto para especificar qual alergia -->--}}
{{--                            <input type="text" name="qual_tipo_alergia" id="qual_tipo_alergia"--}}
{{--                                   class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm hidden"--}}
{{--                                   placeholder="Informe qual alergia">--}}


{{--                            @error('qual_tipo_alergia')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <script>--}}
{{--                            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                                const selectAlergia = document.getElementById('tipo_alergia');--}}
{{--                                const inputQualAlergia = document.getElementById('qual_tipo_alergia');--}}


{{--                                // Função para mostrar ou ocultar o campo de texto--}}
{{--                                function toggleTextField() {--}}
{{--                                    if (selectAlergia.value === "2") {--}}
{{--                                        inputQualAlergia.classList.remove('hidden');--}}
{{--                                    } else {--}}
{{--                                        inputQualAlergia.classList.add('hidden');--}}
{{--                                    }--}}
{{--                                }--}}


{{--                                // Evento de mudança no select--}}
{{--                                selectAlergia.addEventListener('change', toggleTextField);--}}


{{--                                // Executar a lógica inicial caso haja valores preenchidos--}}
{{--                                toggleTextField();--}}
{{--                            });--}}
{{--                        </script>--}}


{{--                        <!-- 15º Nível de Estresse -->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="nivel_estresse" class="block text-sm font-medium text-gray-700">Nível de--}}
{{--                                Estresse</label>--}}
{{--                            <select name="nivel_estresse" id="nivel_estresse"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($nivel_estresse as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('nivel_estresse') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('nivel_estresse')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <!--16º Qual é o seu objetivo principal ao participar das sessões de massoterapia?-->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="objetivo_sessoes_massoterapia" class="block text-sm font-medium text-gray-700">--}}
{{--                                Qual é o seu objetivo principal ao participar das sessões de massoterapia?--}}
{{--                            </label>--}}
{{--                            <select name="objetivo_sessoes_massoterapia" id="objetivo_sessoes_massoterapia"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($objetivo_sessoes_massoterapia as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('objetivo_sessoes_massoterapia') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}


{{--                            <input type="text" name="qual_objetivo_sessoes_massoterapia" id="qual_objetivo_sessoes_massoterapia" class="hidden mt-2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Informe seu objetivo">--}}


{{--                            @error('qual_objetivo_sessoes_massoterapia')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <script>--}}
{{--                            document.addEventListener("DOMContentLoaded", function () {--}}
{{--                                const selectObjetivoSessoesMassoterapia = document.getElementById("objetivo_sessoes_massoterapia");--}}
{{--                                const inputQualObjetivo = document.getElementById("qual_objetivo_sessoes_massoterapia");--}}


{{--                                selectObjetivoSessoesMassoterapia.addEventListener("change", function () {--}}
{{--                                    if (this.value === "6") {--}}
{{--                                        inputQualObjetivo.classList.remove("hidden");--}}
{{--                                    } else {--}}
{{--                                        inputQualObjetivo.classList.add("hidden");--}}
{{--                                        inputQualObjetivo.value = ""; // Limpar campo quando ocultado--}}
{{--                                    }--}}
{{--                                });--}}
{{--                            });--}}
{{--                        </script>--}}


{{--                        <!-- 18º  Orientação Sexual -->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="orientacao_sexual" class="block text-sm font-medium text-gray-700">Orientacao--}}
{{--                                Sexual</label>--}}
{{--                            <select name="orientacao_sexual" id="orientacao_sexual"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($orientacao_sexual as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('orientacao_sexual') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('orientacao_sexual')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <!-- 19º Grupo Étnico -->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="grupo_etnico" class="block text-sm font-medium text-gray-700">Grupo--}}
{{--                                Étnico</label>--}}
{{--                            <select name="grupo_etnico" id="grupo_etnico"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($grupo_etnicos as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('grupo_etnico') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}


{{--                            <input type="text" name="qual_grupo_etnico" id="qual_etnico" class="hidden">--}}
{{--                            <!--20º Qual . Grupo Étnico:-->--}}
{{--                            @error('qual_grupo_etnico')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <script>--}}
{{--                            document.addEventListener("DOMContentLoaded", function () {--}}
{{--                                const selectGrupoEtnico = document.getElementById("grupo_etnico");--}}
{{--                                const inputQualEtnico = document.getElementById("qual_etnico");--}}


{{--                                selectGrupoEtnico.addEventListener("change", function () {--}}
{{--                                    if (this.value === "6") {--}}
{{--                                        inputQualEtnico.classList.remove("hidden");--}}
{{--                                    } else {--}}
{{--                                        inputQualEtnico.classList.add("hidden");--}}
{{--                                    }--}}
{{--                                });--}}
{{--                            });--}}
{{--                        </script>--}}


{{--                        <!-- 21º Cor de acordo com os critério do IBGE-->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="cor_pele" class="block text-sm font-medium text-gray-700">Cor de acordo com os--}}
{{--                                critério do IBGE?</label>--}}
{{--                            <select name="cor_pele" id="orientacao_sexual"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($cor_pele as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('cor_pele') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('cor_pele')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <!-- 22º Você autoriza a realização de registros fotográficos para fins de divulgação do projeto (sempre respeitando o direito de imagem)-->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="registro_fotografico" class="block text-sm font-medium text-gray-700">Você autoriza a realização de registros fotográficos para fins de divulgação do projeto--}}
{{--                                (sempre respeitando o direito de imagem)?</label>--}}
{{--                            <select name="registro_fotografico" id="registro_fotografico"--}}
{{--                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                                <option value="">Selecione</option>--}}
{{--                                @foreach ($registro_fotografico as $grupo)--}}
{{--                                    <option value="{{ $grupo->id }}" {{ old('registro_fotografico') == $grupo->id ? 'selected' : '' }}>--}}
{{--                                        {{ $grupo->valor }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('cor_pele')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <!-- Gostaria de fazer alguma observação adicional sobre sua saúde física ou emocional?-->--}}
{{--                        <div class="mb-4">--}}
{{--                            <label for="obs_adicional_saude" class="block text-sm font-medium text-gray-700">--}}
{{--                                Gostaria de fazer alguma observação adicional sobre sua saúde física ou emocional?--}}
{{--                            </label>--}}
{{--                            <textarea name="obs_adicional_saude" id="obs_adicional_saude"--}}
{{--                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"--}}
{{--                                      placeholder="Digite aqui suas observações adicionais sobre sua saúde física ou emocional"></textarea>--}}


{{--                            @error('obs_adicional_saude')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <div class="mb-4">--}}
{{--                            <label for="user_id" class="block text-sm font-medium text-gray-700">ID do Usuário</label>--}}
{{--                            <input type="text" name="user_id" id="user_id" value="{{ old('user_id') }}"--}}
{{--                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">--}}
{{--                            @error('user_id')--}}
{{--                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}


{{--                        <div class="flex justify-end">--}}
{{--                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">--}}
{{--                                Cadastrar Avaliação--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}



