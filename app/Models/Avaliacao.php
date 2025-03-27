<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacao';

    protected $fillable = [
        'user_id', 'sessoes_massoterapia_anteriormente', 'condicao_medica_diagnosticada', 'qual_condicao_medica_diagnosticada',
        'problema_saude_fisica', 'qual_problema_saude_fisica', 'problema_saude_emocional', 'qual_problema_saude_emocional',
        'tratamento_emocional_mental', 'qual_tratamento_emocional_mental',
        'medicacao_controlada', 'restricao_fisica', 'qual_restricao_fisica', 'tipo_alergia', 'qual_tipo_alergia',
        'nivel_estresse', 'objetivo_sessoes_massoterapia', 'qual_objetivo_sessoes_massoterapia',
        'orientacao_sexual', 'grupo_etnico', 'qual_grupo_etnico', 'cor_pele', 'registro_fotografico', 'obs_adicional_saude'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'sessoes_massoterapia_anteriormente' => 'integer',
        'condicao_medica_diagnosticada' => 'integer',
        'qual_condicao_medica_diagnosticada' => 'string',
        'problema_saude_fisica' => 'integer',
        'qual_problema_saude_fisica' => 'string',
        'problema_saude_emocional' => 'integer',
        'qual_problema_saude_emocional' => 'string',
        'tratamento_emocional_mental' => 'integer',
        'qual_tratamento_emocional_mental' => 'string',
        'medicacao_controlada' => 'integer',
        'restricao_fisica' => 'integer',
        'qual_restricao_fisica' => 'string',
        'tipo_alergia' => 'integer',
        'qual_tipo_alergia' => 'string',
        'nivel_estresse' => 'integer',
        'objetivo_sessoes_massoterapia' => 'integer',
        'qual_objetivo_sessoes_massoterapia' => 'string',
        'orientacao_sexual' => 'integer',
        'grupo_etnico' => 'integer',
        'qual_grupo_etnico' => 'string',
        'cor_pele' => 'integer',
        'registro_fotografico' => 'integer',
        'obs_adicional_saude' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function grupoEtnico()
    {
        return $this->belongsTo(GrupoEtnico::class, 'grupo_etnico');
    }

// Adicionando a relação com o modelo OrientacaoSexual
    public function orientacaoSexual()
    {
        return $this->belongsTo(OrientacaoSexual::class, 'orientacao_sexual');
    }

    public function doenca()
    {
        return $this->belongsTo(Doenca::class);
    }

    public function nivelEstresse()
    {
        return $this->belongsTo(NivelEstresse::class, 'nivel_estresse');
    }

    public function sessoesMassoterapiaAnteriormente()
    {
        return $this->belongsTo(SessoesMassoterapiaAnteriormente::class, 'sessoes_massoterapia_anteriormente');
    }

    public function condicaoMedicaDiagnosticada()
    {
        return $this->belongsTo(CondicaoMedicaDiagnosticada::class, 'condicao_medica_diagnosticada');
    }

    public function objetivoSessoesMassoterapia()
    {
        return $this->belongsTo(ObjetivoSessoesMassoterapia::class, 'objetivo_sessoes_massoterapia');
    }

    public function corPele()
    {
        return $this->belongsTo(CorPele::class, 'cor_pele');
    }

    public function medicacaoControlada()
    {
        return $this->belongsTo(MedicacaoControlada::class, 'medicacao_controlada');
    }
    /** /**Começa aqui os ajustes */
    public function problemaSaudeFisica()
    {
        return $this->belongsTo(ProblemaSaudeFisico::class, 'problema_saude_fisica');
    }

    public function problemaSaudeEmocional()
    {
        return $this->belongsTo(ProblemaSaudeEmocional::class, 'problema_saude_emocional');
    }

    public function tratamentoEmocionalMental()
    {
        return $this->belongsTo(TratamentoEmocionalMental::class, 'tratamento_emocional_mental');
    }
    public function tipoAlergia()
    {
        return $this->belongsTo(TipoAlergia::class, 'tipo_alergia');
    }

    public function restricaoFisica()
    {
        return $this->belongsTo(RestricaoFisica::class, 'restricao_fisica', 'id');
    }

    public function obsAdicionalSaude()
    {
        return $this->belongsTo(ObsAdicionalSaude::class, 'obs_adicional_saude', 'id');
    }

    public function registroFotografico()
    {
        return $this->belongsTo(RegistroFotografico::class, 'registro_fotografico');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
