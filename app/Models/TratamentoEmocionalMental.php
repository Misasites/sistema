<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TratamentoEmocionalMental extends Model
{
    use HasFactory;

    protected $table = 'tratamento_emocional_mental'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
