<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doenca extends Model
{
    use HasFactory;

    protected $table = 'doenca'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
