<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{    
    protected $fillable = [
        'nome', 'data_nascimento', 'telefone', 'email', 'cpf', 'foto',
    ];
}
