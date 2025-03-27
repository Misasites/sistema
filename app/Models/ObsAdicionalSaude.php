<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObsAdicionalSaude extends Model
{
    use HasFactory;

    protected $table = 'obs_adicional_saude'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis
}
