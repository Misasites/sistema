@php use App\Models\Avaliacao;use App\Models\User;use Carbon\Carbon; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard de Avaliações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                @if(Auth::user()->nivel->id == 1)
                    <!-- Card 1 - Total de Usuários -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Total de Usuários</h3>
                        <p class="text-3xl font-bold text-blue-600">

                            <!-- Acessando o id da relação 'nivel' -->
                            <!-- Se o usuário for de nível 1 (Administrador), exibe o total de usuários cadastrados no sistema -->
                            {{ User::count() }}
                            {{--                        @else--}}
                            {{--                            <!-- Se o usuário não for de nível 1 (não administrador), exibe a quantidade de usuários de nível 2 -->--}}
                            {{--                            {{ User::whereHas('nivel', function ($query) {--}}
                            {{--                                $query->where('id', 2);--}}
                            {{--                            })->count() }}--}}

                        </p>
                    </div>
                @endif


                <!-- Card 2 - Avaliações -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700">Total de Avaliações</h3>
                    <p class="text-3xl font-bold text-blue-600">
                        @if(Auth::user()->nivel->id == 1)
                            <!-- Ajuste o acesso ao valor do nível -->
                            <!-- Exibe todas as avaliações cadastradas no sistema para o usuário de nível 1 -->
                            {{ Avaliacao::count() }}
                        @else
                            <!-- Exibe a quantidade de avaliações cadastradas para o usuário específico -->
                            {{ Avaliacao::where('user_id', Auth::id())->count() }}
                        @endif
                    </p>
                </div>


                {{--                <!-- Card 3 - Grupo Étnico -->--}}
                {{--                <div class="bg-white p-6 rounded-lg shadow">--}}
                {{--                    <h3 class="text-lg font-semibold text-gray-700">Grupo Étnico</h3>--}}
                {{--                    <p class="text-3xl font-bold text-blue-600">--}}
                {{--                        {{ $avaliacao->grupoEtnico->valor ?? 'Não especificado' }}--}}
                {{--                    </p>--}}
                {{--                </div>--}}


                {{--                <!-- Card 4 - Orientação Sexual -->--}}
                {{--                <div class="bg-white p-6 rounded-lg shadow">--}}
                {{--                    <h3 class="text-lg font-semibold text-gray-700">Orientação Sexual</h3>--}}
                {{--                    <p class="text-3xl font-bold text-green-600">{{ $avaliacao->orientacaoSexual->valor ?? 'Não especificado' }}</p>--}}
                {{--                </div>--}}

                {{--                <!-- Card 5 - Sessões Massoterapia Anteriormente -->--}}
                {{--                <div class="bg-white p-6 rounded-lg shadow">--}}
                {{--                    <h3 class="text-lg font-semibold text-gray-700">Sessões Massoterapia Anteriormente</h3>--}}
                {{--                    <p class="text-3xl font-bold text-purple-600">{{ $avaliacao->sessoesMassoterapiaAnteriormente->valor ?? 'Não especificado' }}</p>--}}
                {{--                </div>--}}

                {{--                <!-- Card 6 - Nível de Estresse -->--}}
                {{--                <div class="bg-white p-6 rounded-lg shadow">--}}
                {{--                    <h3 class="text-lg font-semibold text-gray-700">Nível de Estresse</h3>--}}
                {{--                    <p class="text-3xl font-bold text-red-600">{{ $avaliacao->nivelEstresse->valor ?? 'Não especificado' }}</p>--}}
                {{--                </div>--}}
            </div>

            <!-- Gráfico de Avaliações -->
            <div class="mt-6 bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Gráfico de Avaliações</h3>
                <canvas id="evaluationChart"></canvas>
            </div>

            <!-- Gráfico de Usuários Cadastrados -->
{{--            <div class="mt-6 bg-white p-6 rounded-lg shadow">--}}
{{--                <h3 class="text-lg font-semibold text-gray-700 mb-4">Gráfico de Usuários Cadastrados</h3>--}}
{{--                <canvas id="evaluationChartt"></canvas>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('evaluationChart').getContext('2d');

            // Passa os meses automaticamente do ano atual para JavaScript
            const labels = {!! json_encode(collect(range(1, 12))->map(fn($month) => Carbon::create(null, $month)->translatedFormat('M'))) !!};

            // Busca os dados dinamicamente no backend
            const data = {!! json_encode(collect(range(1, 12))->map(function ($month) {
            return Auth::user()->nivel->id == 1
                ? Avaliacao::whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->count()
                : Avaliacao::where('user_id', Auth::id())->whereYear('created_at', date('Y'))->whereMonth('created_at', $month)->count();
        })) !!};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Nº Avaliações Mensais',
                        data: data,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>
</x-app-layout>
