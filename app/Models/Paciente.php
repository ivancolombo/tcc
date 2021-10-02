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
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function endereco()
    {
        return $this->hasOne(EnderecoPaciente::class);
    }

    public function getFoto() {        
        return Storage::url($this->foto);
    }

    public function getTelefone()
    {
        $mask = strlen($this->telefone) === 11? "(%s%s) %s%s%s%s%s-%s%s%s%s" : "(%s%s) %s%s%s%s-%s%s%s%s";
        
        return vsprintf($mask, str_split($this->telefone));
    }

    public function getCpf()
    {
        $mask = "%s%s%s.%s%s%s.%s%s%s-%s%s";
        
        return vsprintf($mask, str_split($this->cpf));
    }

}
