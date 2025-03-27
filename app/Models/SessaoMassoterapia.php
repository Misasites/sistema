<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessaoMassoterapia extends Model
{
    use HasFactory;

    protected $table = 'sessao_massoterapia'; // Definir o nome da tabela, se necessário.
    protected $fillable = ['valor']; // Atributos que podem ser preenchidos em massa
}

