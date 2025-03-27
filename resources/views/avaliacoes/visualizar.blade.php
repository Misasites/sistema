{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">--}}
{{--            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">--}}


{{--    <!-- Scripts -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container mx-auto px-4 py-6">--}}
{{--    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Detalhes da Avaliação #{{ $avaliacao->id }}</h1>--}}

{{--    <div class="overflow-x-auto bg-white rounded-lg shadow-md p-4">--}}
{{--        <table class="min-w-full table-auto">--}}
{{--            <thead>--}}
{{--            <tr class="border-b">--}}
{{--                <th class="px-4 py-2 text-left font-semibold text-gray-700">Título</th>--}}
{{--                <th class="px-4 py-2 text-left font-semibold text-gray-700">Definição (valor)</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Grupo Étnico</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->grupoEtnico->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Orientação Sexual</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->orientacaoSexual->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Sessões Massoterapia Anteriormente</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->sessoesMassoterapiaAnteriormente->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Nível de Estresse</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->nivelEstresse->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Condição Médica Diagnosticada</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->condicaoMedicaDiagnosticada->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Cor da Pele</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->corPele->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Medicamentos Controlados</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->medicacaoControlada->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Objetivo Sessões Massoterapia</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->objetivoSessoesMassoterapia->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Problema de Saúde Física</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->problemaSaudeFisica->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Problema de Saúde Emocional</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->problemaSaudeEmocional->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Tratamento Emocional Mental</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->tratamentoEmocionalMental->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Tipo de Alergia</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->tipoAlergia->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Restrição Física</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->restricaoFisica->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Restrição Fotográfico</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->registroFotografico->valor ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            <tr class="border-b">--}}
{{--                <td class="px-4 py-2">Observações Adicionais</td>--}}
{{--                <td class="px-4 py-2">{{ $avaliacao->obs_adicional_saude ?? 'Não especificado' }}</td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}













    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Detalhes da Avaliação #{{ $avaliacao->id }}</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 bg-white rounded-lg">
                <thead>
                <tr class="bg-gray-200 text-gray-700 text-left">
                    <th class="px-6 py-3 font-semibold">Título</th>
                    <th class="px-6 py-3 font-semibold">Definição (valor)</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                @foreach ([
                    'Grupo Étnico' => $avaliacao->grupoEtnico->valor ?? 'Não especificado',
                    'Orientação Sexual' => $avaliacao->orientacaoSexual->valor ?? 'Não especificado',
                    'Sessões Massoterapia Anteriormente' => $avaliacao->sessoesMassoterapiaAnteriormente->valor ?? 'Não especificado',
                    'Nível de Estresse' => $avaliacao->nivelEstresse->valor ?? 'Não especificado',
                    'Condição Médica Diagnosticada' => $avaliacao->condicaoMedicaDiagnosticada->valor ?? 'Não especificado',
                    'Cor da Pele' => $avaliacao->corPele->valor ?? 'Não especificado',
                    'Medicamentos Controlados' => $avaliacao->medicacaoControlada->valor ?? 'Não especificado',
                    'Objetivo Sessões Massoterapia' => $avaliacao->objetivoSessoesMassoterapia->valor ?? 'Não especificado',
                    'Problema de Saúde Física' => $avaliacao->problemaSaudeFisica->valor ?? 'Não especificado',
                    'Problema de Saúde Emocional' => $avaliacao->problemaSaudeEmocional->valor ?? 'Não especificado',
                    'Tratamento Emocional Mental' => $avaliacao->tratamentoEmocionalMental->valor ?? 'Não especificado',
                    'Tipo de Alergia' => $avaliacao->tipoAlergia->valor ?? 'Não especificado',
                    'Restrição Física' => $avaliacao->restricaoFisica->valor ?? 'Não especificado',
                    'Restrição Fotográfico' => $avaliacao->registroFotografico->valor ?? 'Não especificado',
                    'Observações Adicionais' => $avaliacao->obs_adicional_saude->valor ?? 'Não especificado',
                ] as $titulo => $valor)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-gray-700 font-medium">{{ $titulo }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $valor }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
