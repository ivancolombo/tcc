<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'data', 'descricao', 'sala_id', 'descricao_paciente'
    ];

    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'id', 'paciente_id');
    }

}
