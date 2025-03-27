<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemaSaudeEmocional extends Model
{
    use HasFactory;

    protected $table = 'problema_saude_emocional'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
