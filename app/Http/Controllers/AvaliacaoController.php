<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\CondicaoMedicaDiagnosticada;
use App\Models\Doenca;
use App\Models\GrupoEtnico;
use App\Models\OrientacaoSexual;
use App\Models\NivelEstresse;
use App\Models\CorPele;
use App\Models\ObjetivoSessoesMassoterapia;
use App\Models\MedicacaoControlada;
use App\Models\ProblemaSaudeEmocional;
use App\Models\ProblemaSaudeFisico;
use App\Models\RegistroFotografico;
use App\Models\RestricaoFisica;
use App\Models\SessoesMassoterapiaAnteriormente;
use App\Models\TipoAlergia;
use App\Models\TratamentoEmocionalMental;
use App\Models\ObsAdicionalSaude;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AvaliacaoController extends Controller
{
    /**
     * Exibir uma lista das avaliações.
     */
    public function index()
    {
        // Verifica o nivel_id do usuário logado
        $user = auth()->user();

        // Se o nivel_id do usuário for igual a 1, mostra todos os registros
        if ($user->nivel_id == 1) {
            $avaliacoes = Avaliacao::with([
                'grupoEtnico', 'orientacaoSexual', 'sessoesMassoterapiaAnteriormente',
                'nivelEstresse', 'condicaoMedicaDiagnosticada', 'corPele', 'medicacaoControlada',
                'problemaSaudeFisica', 'problemaSaudeEmocional',
                'tratamentoEmocionalMental', 'tipoAlergia', 'tratamentoEmocionalMental',
                'registroFotografico', 'restricaoFisica', 'obsAdicionalSaude'
            ])->paginate(20);
        } else {
            // Caso contrário, mostra apenas as avaliações do usuário logado
            $avaliacoes = Avaliacao::with([
                'grupoEtnico', 'orientacaoSexual', 'sessoesMassoterapiaAnteriormente',
                'nivelEstresse', 'condicaoMedicaDiagnosticada', 'corPele', 'medicacaoControlada',
                'problemaSaudeFisica', 'problemaSaudeEmocional',
                'tratamentoEmocionalMental', 'tipoAlergia', 'tratamentoEmocionalMental',
                'registroFotografico', 'restricaoFisica', 'obsAdicionalSaude'
            ])->where('user_id', $user->id) // Filtra pelas avaliações do usuário logado
            ->paginate(20);
        }

        return view('avaliacoes.index', compact('avaliacoes'));
    }


    public function gerarLinkWhatsApp($id)
    {
        // Buscar a avaliação pelo ID
        $avaliacao = Avaliacao::with('user')->findOrFail($id);

        // Verificar se o usuário tem contato cadastrado
        if (empty($avaliacao->user->contato)) {
            return back()->with('error', 'Número de contato não encontrado.');
        }

        // Criar um hash único baseado no ID da avaliação
        $hash = hash('sha256', $avaliacao->id . config('app.key'));

        // Criar a URL para visualizar a avaliação (agora com "/visualizar")
        $urlAvaliacao = route('avaliacoes.visualizar', ['hash' => $hash]);

        // Construir a mensagem formatada para o WhatsApp
        $textoAvaliacao = "Olá {$avaliacao->user->name}, segue o resumo da sua avaliação:\n";
        $textoAvaliacao .= "📄 Visualize sua avaliação aqui: \n";
        $textoAvaliacao .= $urlAvaliacao; // Link para a visualização da avaliação

        // Criar o link para WhatsApp (formato compatível com celular e web)
        $contato = preg_replace('/\D/', '', $avaliacao->user->contato); // Remove caracteres não numéricos
        if (strlen($contato) < 11) {
            return back()->with('error', 'Número de contato inválido.');
        }

        $link = "https://web.whatsapp.com/send?phone=55{$contato}&text=" . rawurlencode($textoAvaliacao);

        return redirect()->away($link); // Redireciona para o WhatsApp com a mensagem
    }


    public function visualizarAvaliacao($hash)
    {


        // Buscar todas as avaliações e comparar o hash
        $avaliacao = Avaliacao::all()->first(function ($avaliacao) use ($hash) {
            $generatedHash = hash('sha256', $avaliacao->id . config('app.key'));

            return $generatedHash === $hash;
        });

        // Se o hash for inválido, retorna erro 404
        if (!$avaliacao) {
            abort(404);
        }

        return view('avaliacoes.visualizar', compact('avaliacao'));
    }


    /* Mostrar o formulário de criação de uma nova avaliação.*/
    public function create()
    {
        // Sim / Qual
        $condicao_medica_diagnosticada = CondicaoMedicaDiagnosticada::all();
        $problema_saude_fisica = ProblemaSaudeFisico::all();
        $problema_saude_emocional = ProblemaSaudeEmocional::all();
        $doenca = Doenca::all();
        $tratamento_emocional_mental = TratamentoEmocionalMental::all();
        $restricao_fisica = RestricaoFisica::all();
        $tipo_alergia = TipoAlergia::all();
        $grupo_etnicos = GrupoEtnico::all();
        $orientacao_sexual = OrientacaoSexual::all();
        $sessoes_massoterapia_anteriormente = SessoesMassoterapiaAnteriormente::all();
        $nivel_estresse = NivelEstresse::all();
        $cor_pele = CorPele::all();
        $objetivo_sessoes_massoterapia = ObjetivoSessoesMassoterapia::all();
        $medicacao_controlada = MedicacaoControlada::all();
        $registro_fotografico = RegistroFotografico::all();


        return view('avaliacoes.create', compact('grupo_etnicos', 'orientacao_sexual',
            'sessoes_massoterapia_anteriormente',
            'nivel_estresse'
            , 'cor_pele', 'medicacao_controlada', 'registro_fotografico',
            'condicao_medica_diagnosticada', 'condicao_medica_diagnosticada', 'problema_saude_fisica',
            'problema_saude_emocional', 'tratamento_emocional_mental',
            'restricao_fisica', 'tipo_alergia', 'grupo_etnicos',
            'objetivo_sessoes_massoterapia', 'doenca'
        ));
    }


    /** Armazenar uma nova avaliação no banco de dados.*/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sessoes_massoterapia_anteriormente' => 'required|integer',
            'condicao_medica_diagnosticada' => 'nullable|integer',
            'qual_condicao_medica_diagnosticada' => 'nullable|string|max:255',
            'problema_saude_fisica' => 'nullable|integer',
            'qual_problema_saude_fisica' => 'nullable|string|max:255',
            'problema_saude_emocional' => 'nullable|integer',
            'qual_problema_saude_emocional' => 'nullable|string|max:255',
            'tratamento_emocional_mental' => 'nullable|integer',
            'qual_tratamento_emocional_mental' => 'nullable|string|max:255',
            'medicacao_controlada' => 'nullable|integer',
            'restricao_fisica' => 'nullable|integer',
            'qual_restricao_fisica' => 'nullable|string|max:255',
            'tipo_alergia' => 'nullable|integer',
            'qual_tipo_alergia' => 'nullable|string|max:255',
            'nivel_estresse' => 'nullable|integer',

            'qual_objetivo_sessoes_massoterapia' => 'nullable|string|max:255',
            'orientacao_sexual' => 'nullable|integer',
            'grupo_etnico' => 'nullable|integer',
            'qual_grupo_etnico' => 'nullable|string|max:255',
            'cor_pele' => 'nullable|integer',
            'registro_fotografico' => 'nullable|integer',
            'obs_adicional_saude' => 'nullable|string',
            'lista_doenca' => 'nullable|array', // Deve ser um array
            'lista_doenca.*' => 'integer|exists:doenca,id', // Cada valor deve ser um ID válido
            'objetivo_sessoes_massoterapia' => 'nullable|array',
            'objetivo_sessoes_massoterapia.*'=> 'integer|exists:objetivo_sessoes_massoterapia,id',

//            'lista_objetivo'  => 'nullable|array', // Deve ser um array
//            'lista_objetivo.*' => 'integer|exists:objetivo_sessoes_massoterapia,id', // Cada valor deve ser um ID válido
        ]);

// Adiciona o ID do usuário logado
        $validated['user_id'] = Auth::id();

// Converte a lista de doenças para JSON antes de salvar
        $validated['lista_doenca'] = json_encode($request->lista_doenca ?? []);

        // Converte a lista de objetivos sessoes massoterapia para JSON antes de salvar
        $validated['objetivo_sessoes_massoterapia'] = json_encode($request->objetivo_sessoes_massoterapia ?? []);

// Cria a avaliação
        Avaliacao::create($validated);

        return redirect()->route('avaliacoes.index')->with('success', 'Avaliação criada com sucesso.');


    }



    /** Exibir detalhes de uma avaliação específica.*/
//    public function show(Avaliacao $avaliacao)
//    {
//
//        return view('avaliacoes.show', compact('avaliacao'));
//    }

// Exibe os detalhes de uma avaliação específica
    public function show($id)
    {
        $avaliacao = Avaliacao::with([
            'grupoEtnico',
            'orientacaoSexual',
            'sessoesMassoterapiaAnteriormente',
            'nivelEstresse',
            'condicaoMedicaDiagnosticada',
            'corPele',
            'medicacaoControlada',
            'problemaSaudeFisica',
            'problemaSaudeEmocional',
            'tratamentoEmocionalMental',
            'tipoAlergia',
            'registroFotografico',
            'restricaoFisica',
            'obsAdicionalSaude'
        ])->findOrFail($id);

        // Decodifica a lista de doenças (vem como JSON no banco)
        $doencasRelacionadas = collect(json_decode($avaliacao->lista_doenca, true) ?? [])->pluck('id')->toArray();
        $doencas = Doenca::whereIn('id', $doencasRelacionadas)->get();

        // Decodifica os objetivos das sessões de massoterapia
        $objetivosRelacionados = json_decode($avaliacao->objetivo_sessoes_massoterapia, true) ?? [];

        // Busca os objetivos pelo ID
        $objetivos = ObjetivoSessoesMassoterapia::whereIn('id', $objetivosRelacionados)->get();


        return view('avaliacoes.show', compact('avaliacao', 'doencas', 'objetivos', 'objetivosRelacionados'));
    }





    /** Mostrar o formulário de edição de uma avaliação existente */
    public function edit($id)
    {
        // Recupera a avaliação existente
        $avaliacao = Avaliacao::findOrFail($id);

        // Carrega as opções para o formulário
        $grupo_etnico = GrupoEtnico::all();
        $orientacao_sexual = OrientacaoSexual::all();
        $sessoes_massoterapia_anteriormente = SessoesMassoterapiaAnteriormente::all();
        $nivel_estresse = NivelEstresse::all();
        $cor_pele = CorPele::all();
        $problema_saude_emocional = ProblemaSaudeEmocional::all();
        $objetivo_sessoes_massoterapia = ObjetivoSessoesMassoterapia::all();
        $medicacao_controlada = MedicacaoControlada::all();
        $condicao_medica_diagnosticada = CondicaoMedicaDiagnosticada::all();
        $obs_adicional_saude = ObsAdicionalSaude::all();
        $doenca = Doenca::all();
        $problema_saude_fisica = ProblemaSaudeFisico::all();
        $tratamento_emocional_mental = TratamentoEmocionalMental::all();
        $tipo_alergia = TipoAlergia::all();
        $restricao_fisica = RestricaoFisica::all();
        $registro_fotografico = RegistroFotografico::all();

        // Retorna a view de edição passando os dados necessários
        return view('avaliacoes.edit', compact(
            'avaliacao', 'grupo_etnico', 'orientacao_sexual', 'sessoes_massoterapia_anteriormente',
            'nivel_estresse', 'cor_pele', 'objetivo_sessoes_massoterapia', 'medicacao_controlada',
            'condicao_medica_diagnosticada', 'problema_saude_fisica', 'obs_adicional_saude',
            'registro_fotografico', 'tratamento_emocional_mental', 'tipo_alergia', 'restricao_fisica',
            'doenca', 'problema_saude_emocional',
        ));
    }


    /** Atualizar uma avaliação no banco de dados.*/
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
//                'user_id' => 'required|integer',
                'sessoes_massoterapia_anteriormente' => 'required|integer',

                'condicao_medica_diagnosticada' => 'nullable|integer',
                'qual_condicao_medica_diagnosticada' => 'nullable|string|max:255',
                'problema_saude_fisica' => 'nullable|integer',
                'qual_problema_saude_fisica' => 'nullable|string|max:255',
                'problema_saude_emocional' => 'nullable|integer',
                'qual_problema_saude_emocional' => 'nullable|string|max:255',
                'doenca' => 'nullable|string|max:255',
                'tratamento_emocional_mental' => 'nullable|integer',
                'qual_tratamento_emocional_mental' => 'nullable|string|max:255',
                'medicacao_controlada' => 'nullable|integer',
                'restricao_fisica' => 'nullable|integer',
                'qual_restricao_fisica' => 'nullable|string|max:255',
                'nivel_estresse' => 'nullable|integer',
                'objetivo_sessoes_massoterapia' => 'nullable|integer',
                'qual_objetivo_sessoes_massoterapia' => 'nullable|string|max:255',
                'tipo_alergia' => 'nullable|integer',
                'qual_tipo_alergia' => 'nullable|string|max:255',
                'orientacao_sexual' => 'nullable|integer',
                'grupo_etnico' => 'nullable|integer',
                'cor_pele' => 'nullable|integer',
                'qual_grupo_etnico' => 'nullable|string|max:255',
                'registro_fotografico' => 'nullable|integer',
                'obs_adicional_saude' => 'nullable|string',
            ]);

            $avaliacao = Avaliacao::findOrFail($id);
            $avaliacao->update($validated);


            return redirect()->route('avaliacoes.index')->with('success', 'Avaliação atualizada com sucesso.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('avaliacoes.index')->with('error', 'Avaliação não encontrada.');
        } catch (\Exception $e) {
            return redirect()->route('avaliacoes.index')->with('error', 'Erro ao atualizar avaliação: ' . $e->getMessage());
        }
    }


    /** Remover uma avaliação do banco de dados.*/

    public function destroy($id)
    {
        try {
            // Procurando a avaliação pelo ID
            $avaliacao = Avaliacao::findOrFail($id);


            // Excluindo a avaliação
            $avaliacao->delete();


            return redirect()->route('avaliacoes.index')->with('success', 'Avaliação excluída com sucesso.');
        } catch (ModelNotFoundException $e) {
            // Caso o modelo não seja encontrado
            return redirect()->route('avaliacoes.index')->with('error', 'Avaliação não encontrada.');
        } catch (\Exception $e) {
            // Captura de erros inesperados
            return redirect()->route('avaliacoes.index')->with('error', 'Erro ao excluir avaliação: ' . $e->getMessage());
        }
    }


}



