<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'status', 'data', 'descricao', 'sala_id'
    ];
}
