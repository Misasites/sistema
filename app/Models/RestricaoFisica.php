<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestricaoFisica extends Model
{
    use HasFactory;

    protected $table = 'restricao_fisica'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
