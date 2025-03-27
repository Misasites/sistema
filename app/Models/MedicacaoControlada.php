<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicacaoControlada extends Model
{
    use HasFactory;

    protected $table = 'medicacao_controlada'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
