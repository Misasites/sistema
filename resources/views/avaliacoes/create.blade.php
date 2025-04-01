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


                    <form method="POST" action="{{ route('avaliacoes.store') }}"
                          class="p-6 bg-white rounded-lg shadow-md">
                        @csrf

                        <div class="space-y-6 mt-4">

                            <!-- 1º Você já participou de sessões de massoterapia anteriormente? -->
                            <div class="bg-white p-4 rounded-md shadow-md">
                                <label for="sessoes_massoterapia_anteriormente"
                                       class="block text-sm font-medium text-gray-900">
                                    1. Você já participou de sessões de massoterapia anteriormente?
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
                                    2. Você possui alguma condição médica diagnosticada?
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
                                <!-- 2.1º Qual condição médica diagnosticada? -->
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
                                    3. Histórico de problemas de saúde física (ex.: hipertensão, diabetes, problemas
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
                                <!-- 3.1 Qual histórico de problemas de saúde física -->
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
                                    4. Histórico de problemas de saúde emocional?
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
                                    <label class="block text-sm font-medium text-gray-700">Selecione as doenças</label>
                                    <div class="space-y-2">
                                        @foreach ($doenca as $do)
                                            <div class="flex items-center">
                                                <input type="checkbox" name="lista_doenca[]" value="{{ $do->id }}"
                                                       class="doenca-checkbox"
                                                    {{ in_array($do->id, old('lista_doenca', $avaliacao->lista_doenca ?? [])) ? 'checked' : '' }}>
                                                <label class="text-sm text-gray-700">{{ $do->valor }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- 4.1º Histórico de problemas de saúde emocional-->
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


                            <!-- 5ºEstá atualmente em tratamento para alguma condição emocional ou mental?-->
                            <div class="bg-white p-4 rounded-md shadow-md">
                                <label class="block text-sm font-medium text-gray-700">
                                    5. Está atualmente em tratamento para alguma condição emocional ou mental?
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

                                <!-- 5.1ºQual o tratamento condição emocional ou mental?-->
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

                            <!-- 6° Faz uso de medicação controlada? -->
                            <div class="bg-white p-4 rounded-md shadow-md">
                                <label class="block text-sm font-medium text-gray-700">
                                    6. Faz uso de medicação controlada?
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


                            <!-- 7.º Você possui alguma restrição física que possa afetar a prática de massoterapia?-->
                            <div class="bg-white p-4 rounded-md shadow-md">
                                <label class="block text-sm font-medium text-gray-700">
                                    7. Você possui alguma restrição física que possa afetar a prática de massoterapia?
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

                                <!-- 7.1º Qual restrição física?-->
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

                            <!-- 8º Possui alergia a algum tipo de óleo, creme ou substância usada em massagem?-->
                            <div class="bg-white p-4 rounded-md shadow-md">
                                <label class="block text-sm font-medium text-gray-700">
                                    8. Possui alergia a algum tipo de óleo, creme ou substância usada em massagem?
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

                                <!-- 8.1º Qual tipo de alergia?-->
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


                            <!-- 9º Nível de Estresse?-->
                            <div class="bg-white p-4 rounded-md shadow-md">
                                <label for="nivel_estresse" class="block text-sm font-medium text-gray-700">
                                    9. Nível de Estresse
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


                            <!-- 10° Qual o Objetivo da sessoes massoterapia? -->
                            <div class="bg-white p-4 rounded-md shadow-md">
                                <label class="block text-sm font-medium text-gray-700">
                                    10. Qual é o seu objetivo principal ao participar das sessões de massoterapia?
                                </label>
                                <div class="mt-2 space-y-2">
                                    @foreach ($objetivo_sessoes_massoterapia as $grupo)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="objetivo_sessoes_massoterapia[]"
                                                   value="{{ $grupo->id }}"
                                                   class="form-checkbox h-4 w-4 text-indigo-600"
                                                {{ in_array($grupo->id, old('objetivo_sessoes_massoterapia', [])) ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-700">{{ $grupo->valor }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- 10.1° Outro objetivo -->
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
                                    const checkboxes = document.getElementsByName("objetivo_sessoes_massoterapia[]");
                                    const inputOutro = document.getElementById("qual_objetivo_sessoes_massoterapia");

                                    checkboxes.forEach(function (checkbox) {
                                        checkbox.addEventListener("change", function () {
                                            const isChecked = Array.from(checkboxes).some(cb => cb.checked && cb.value === "6");
                                            if (isChecked) {
                                                inputOutro.classList.remove("hidden");
                                                inputOutro.setAttribute("required", "required");
                                            } else {
                                                inputOutro.classList.add("hidden");
                                                inputOutro.removeAttribute("required");
                                                inputOutro.value = "";
                                            }
                                        });
                                    });
                                });
                            </script>


                            <!-- 11º Orientação Sexual-->
                            <div class="mb-4">
                                <label for="orientacao_sexual" class="block text-sm font-medium text-gray-700">
                                    11. Orientação
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


                            <!-- 12º Grupo Étnico -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700"> 12. Grupo Étnico</label>
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
                                <!-- 12.1º Qual o Grupo Étnico -->
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

                            <!-- 13º Cor da Pele -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">
                                    13. Cor de acordo com os critério do IBGE?</label>
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

                            <!--14ºVocê autoriza a realização de registros fotográficos para fins de divulgação do projeto (sempre respeitando o direito de imagem) -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">
                                    14. Você autoriza a realização de
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


                            <!--15ºGostaria de fazer alguma observação adicional sobre sua saúde física ou emocional?-->
                            <div class="mb-4">
                                <label for="obs_adicional_saude" class="block text-sm font-medium text-gray-700">
                                    15. Gostaria de fazer alguma observação adicional sobre sua saúde física ou
                                    emocional?
                                </label>
                                <textarea name="obs_adicional_saude" id="obs_adicional_saude"
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                          placeholder="Digite aqui suas observações adicionais sobre sua saúde física ou emocional"></textarea>


                                @error('obs_adicional_saude')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!--Botões-->
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

