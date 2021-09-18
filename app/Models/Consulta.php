<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'data', 'descricao', 'sala_id'
    ];
}
