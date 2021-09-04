<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class EnderecoPaciente extends Model
{
    protected $table = 'enderecos_pacientes';
    public $timestamps = false;
    protected $fillable = ['cep', 'estado', 'cidade', 'bairro', 'rua'];
}
