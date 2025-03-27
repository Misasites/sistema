<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorPele extends Model
{
    use HasFactory;

    protected $table = 'cor_pele'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}

