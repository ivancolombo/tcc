<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{    
    public $timestamps = false;
    protected $fillable = [
        'data_nascimento', 'telefone', 'cpf', 'foto',
    ];
}
