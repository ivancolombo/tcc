<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = [
        'nome', 'telefone', 'email', 'especialidade', 'crm', 'foto',
    ];
}
