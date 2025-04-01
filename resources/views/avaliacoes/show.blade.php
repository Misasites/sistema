<x-app-layout>
    <div class="container mx-auto px-4 py-6 ">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Detalhes da Avaliação #{{ $avaliacao->id }}</h1>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md p-4">
            <table class="min-w-full table-auto">

                <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Título</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-700">Definição (valor)</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2">1. Sessões Massoterapia Anteriormente</td>
                    <td class="px-4 py-2">{{ $avaliacao->sessoesMassoterapiaAnteriormente->valor ?? 'Não especificado' }}</td>
                </tr>

                <tr class="border-b">
                    <td class="px-4 py-2">2.Condição Médica Diagnosticada</td>
                    <td class="px-4 py-2">{{ $avaliacao->condicaoMedicaDiagnosticada->valor ?? 'Não especificado' }}</td>
                </tr>
                @if (isset($avaliacao->condicaoMedicaDiagnosticada) && $avaliacao->condicaoMedicaDiagnosticada->id == 2)
                    <tr class="border-b">
                        <td class="px-4 py-2">2.1. Qual a Condição Médica Diagnosticada</td>
                        <td class="px-4 py-2">{{ $avaliacao->qual_condicao_medica_diagnosticada ?? 'Não especificado' }}</td>
                    </tr>
                @endif

                <tr class="border-b">
                    <td class="px-4 py-2">3. Problema de Saúde Física</td>
                    <td class="px-4 py-2">{{ $avaliacao->problemaSaudeFisica->valor ?? 'Não especificado' }}</td>
                </tr>

                @if ($avaliacao->problemaSaudeFisica->id == 2)
                    <tr class="border-b">
                        <td class="px-4 py-2">3.1. Qual problema de saúde física</td>
                        <td class="px-4 py-2">{{ $avaliacao->qual_problema_saude_fisica ?? 'Não especificado' }}</td>
                    </tr>
                @endif

                <tr class="border-b">
                    <td class="px-4 py-2">4. Problema de Saúde Emocional</td>
                    <td class="px-4 py-2">{{ $avaliacao->problemaSaudeEmocional->valor ?? 'Não especificado' }}</td>
                </tr>
                @if ($avaliacao->problemaSaudeEmocional->id == 2 && $doencas->isNotEmpty())
                    <tr class="border-b">
                        <td class="px-4 py-2">4.1. Doenças Relacionadas</td>
                        <td class="px-4 py-2">
                            <ul>
                                @foreach ($doencas as $doenca)
                                    <li>{{ $doenca->valor }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif


                <tr class="border-b">
                    <td class="px-4 py-2">5. Tratamento Emocional Mental</td>
                    <td class="px-4 py-2">{{ $avaliacao->tratamentoEmocionalMental->valor ?? 'Não especificado' }}</td>
                </tr>
                @if ($avaliacao->tratamentoEmocionalMental->id == 2)
                    <tr class="border-b">
                        <td class="px-4 py-2">5.1. Quais condições mental</td>
                        <td class="px-4 py-2">{{ $avaliacao->qual_tratamento_emocional_mental ?? 'Não especificado' }}</td>
                    </tr>
                @endif

                <tr class="border-b">
                    <td class="px-4 py-2">6. Medicamentos Controlados</td>
                    <td class="px-4 py-2">{{ $avaliacao->medicacaoControlada->valor ?? 'Não especificado' }}</td>
                </tr>


                <tr class="border-b">
                    <td class="px-4 py-2">7. Restrição Física</td>
                    <td class="px-4 py-2">{{ $avaliacao->restricaoFisica->valor ?? 'Não especificado' }}</td>
                </tr>

                @if ($avaliacao->restricaoFisica->id == 2)
                <tr class="border-b">
                    <td class="px-4 py-2">7.1 Qual a Restrição Física</td>
                    <td class="px-4 py-2">{{ $avaliacao->qual_restricao_fisica ?? 'Não especificado' }}</td>
                </tr>
                @endif


                <tr class="border-b">
                    <td class="px-4 py-2">8. Tipo de Alergia</td>
                    <td class="px-4 py-2">{{ $avaliacao->tipoAlergia->valor ?? 'Não especificado' }}</td>
                </tr>

                @if ($avaliacao->tipoAlergia->id == 2)
                <tr class="border-b">
                    <td class="px-4 py-2">8.1 Quais Tipos de Alergia</td>
                    <td class="px-4 py-2">{{ $avaliacao->qual_tipo_alergia ?? 'Não especificado' }}</td>
                </tr>
                @endif
                <tr class="border-b">
                    <td class="px-4 py-2">9. Nível de Estresse</td>
                    <td class="px-4 py-2">{{ $avaliacao->nivelEstresse->valor ?? 'Não especificado' }}</td>
                </tr>



                <tr class="border-b">
                    <td class="px-4 py-2">10. Objetivo Sessões Massoterapia</td>
                    <td class="px-4 py-2">
                        @if ($objetivos->isNotEmpty())
                            {{ $objetivos->pluck('valor')->implode(', ') }}
                        @else
                            Nenhum objetivo especificado
                        @endif
                    </td>
                </tr>

                @if (in_array(2, $objetivosRelacionados) && $objetivos->isNotEmpty())
                    <tr class="border-b">
                        <td class="px-4 py-2">10.1 Objetivo Sessões Massoterapia</td>
                        <td class="px-4 py-2">
                            <ul>
                                @foreach ($objetivos as $objetivo)
                                    @if ($objetivo->valor !== 'Outro')
                                        <li>{{ $objetivo->valor }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif



                @if (in_array(2, $objetivosRelacionados) && $objetivos->isNotEmpty() && !empty($avaliacao->qual_objetivo_sessoes_massoterapia))
                    <tr class="border-b">
                        <td class="px-4 py-2">10.2 Qual o outro Objetivo Sessões Massoterapia</td>
                        <td class="px-4 py-2">
                            <ul>
                                <li>{{ $avaliacao->qual_objetivo_sessoes_massoterapia ?? "Não informado." }}</li>
                            </ul>
                        </td>
                    </tr>
                @endif




                <tr class="border-b">
                    <td class="px-4 py-2">11. Orientação Sexual</td>
                    <td class="px-4 py-2">{{ $avaliacao->orientacaoSexual->valor ?? 'Não especificado' }}</td>
                </tr>

                <tr class="border-b">
                    <td class="px-4 py-2">12. Grupo Étnico</td>
                    <td class="px-4 py-2">{{ $avaliacao->grupoEtnico->valor ?? 'Não especificado' }}</td>
                </tr>



                <tr class="border-b">
                    <td class="px-4 py-2">13. Cor da Pele</td>
                    <td class="px-4 py-2">{{ $avaliacao->corPele->valor ?? 'Não especificado' }}</td>
                </tr>


                <tr class="border-b">
                    <td class="px-4 py-2">14. Restrição Fotográfico</td>
                    <td class="px-4 py-2">{{ $avaliacao->registroFotografico->valor ?? 'Não especificado' }}</td>
                </tr>

                <tr class="border-b">
                    <td class="px-4 py-2">15. Observações Adicionais</td>
                    <td class="px-4 py-2">{{ $avaliacao->obs_adicional_saude ?? 'Não especificado' }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 space-x-4">
            <a href="{{ route('avaliacoes.index') }}"
               class="btn btn-secondary text-white bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg no_print">
                Voltar para a lista
            </a>
            <a href="{{ route('avaliacoes.edit', $avaliacao->id) }}"
               class="btn btn-primary text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg no_print">
                Editar
            </a>
            <button id="printTableButton" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg mt-4 no_print ">
                Imprimir
            </button>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let printButton = document.getElementById("printTableButton");

                    // Adicionar evento de clique para imprimir a página
                    printButton.addEventListener("click", function () {
                        window.print(); // Chama diretamente a função de impressão da página
                    });
                });
            </script>
        </div>
    </div>

    <style>
        @media print {
            .no_print {
                display: none;
            }
        }

        .navbar, .header, .footer { /* Certifique-se de incluir as classes corretas para a navbar */
            display: none;
        }
    </style>
</x-app-layout>
