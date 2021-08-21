<?php

namespace App\models;

use App\Models\Especialidade;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $fillable = [
        'telefone', 'especialidade_id', 'crm', 'foto',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function especialidade()
    {
        return $this->hasOne(Especialidade::class, 'id', 'especialidade_id');
    }
}
