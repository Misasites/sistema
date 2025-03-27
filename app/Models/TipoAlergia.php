<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAlergia extends Model
{
    use HasFactory;

    protected $table = 'tipo_alergia'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
