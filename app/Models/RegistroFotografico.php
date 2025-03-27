<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroFotografico extends Model
{
    use HasFactory;

    protected $table = 'registro_fotografico'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
