<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrientacaoSexual extends Model
{
    use HasFactory;

    protected $table = 'orientacao_sexual'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
