<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessoesMassoterapiaAnteriormente extends Model
{
    use HasFactory;

    protected $table = 'sessoes_massoterapia_anteriormente'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
