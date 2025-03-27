<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemaSaudeFisico extends Model
{
    use HasFactory;

    protected $table = 'problema_saude_fisica'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
