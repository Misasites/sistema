<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NivelEstresse extends Model
{
    use HasFactory;

    protected $table = 'nivel_estresse'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}

