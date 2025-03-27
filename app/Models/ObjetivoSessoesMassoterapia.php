<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoSessoesMassoterapia extends Model
{
    use HasFactory;

    protected $table = 'objetivo_sessoes_massoterapia'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
