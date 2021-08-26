<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Paciente extends Model
{    
    public $timestamps = false;
    protected $fillable = [
        'data_nascimento', 'telefone', 'cpf', 'foto',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getFoto() {        
        return Storage::url($this->foto);
    }

}
