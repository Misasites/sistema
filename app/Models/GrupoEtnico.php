<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoEtnico extends Model
{
    use HasFactory;

    protected $table = 'grupo_etnico'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
