<?php

namespace App\models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'data', 'descricao', 'sala_id', 'descricao_paciente'
    ];

    public function paciente()
    {
        return $this->hasOne(User::class, 'id', 'paciente_id');
    }

    public function medico()
    {
        return $this->hasOne(User::class, 'id', 'medico_id');
    }

}
