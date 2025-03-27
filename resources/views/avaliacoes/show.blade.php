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
                    <td class="px-4 py-2">Grupo Étnico</td>
                    <td class="px-4 py-2">{{ $avaliacao->grupoEtnico->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Orientação Sexual</td>
                    <td class="px-4 py-2">{{ $avaliacao->orientacaoSexual->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Sessões Massoterapia Anteriormente</td>
                    <td class="px-4 py-2">{{ $avaliacao->sessoesMassoterapiaAnteriormente->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Nível de Estresse</td>
                    <td class="px-4 py-2">{{ $avaliacao->nivelEstresse->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Condição Médica Diagnosticada</td>
                    <td class="px-4 py-2">{{ $avaliacao->condicaoMedicaDiagnosticada->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Cor da Pele</td>
                    <td class="px-4 py-2">{{ $avaliacao->corPele->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Medicamentos Controlados</td>
                    <td class="px-4 py-2">{{ $avaliacao->medicacaoControlada->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Objetivo Sessões Massoterapia</td>
                    <td class="px-4 py-2">{{ $avaliacao->objetivoSessoesMassoterapia->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Problema de Saúde Física</td>
                    <td class="px-4 py-2">{{ $avaliacao->problemaSaudeFisica->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Problema de Saúde Emocional</td>
                    <td class="px-4 py-2">{{ $avaliacao->problemaSaudeEmocional->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Tratamento Emocional Mental</td>
                    <td class="px-4 py-2">{{ $avaliacao->tratamentoEmocionalMental->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Tipo de Alergia</td>
                    <td class="px-4 py-2">{{ $avaliacao->tipoAlergia->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Restrição Física</td>
                    <td class="px-4 py-2">{{ $avaliacao->restricaoFisica->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Restrição Fotográfico</td>
                    <td class="px-4 py-2">{{ $avaliacao->registroFotografico->valor ?? 'Não especificado' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">Observações Adicionais</td>
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
