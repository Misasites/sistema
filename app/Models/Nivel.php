<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'nivel'; // Nome da tabela
    protected $fillable = ['valor']; // Atributos preenchíveis

    public function users()
    {
        return $this->hasMany(User::class, 'nivel_id');  // Relacionamento inverso
    }
}
