<?php

namespace App\models;

use App\Models\Especialidade;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Medico extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'telefone', 'especialidade_id', 'crm', 'foto', 'rqe_1', 'rqe_2'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function especialidade()
    {
        return $this->hasOne(Especialidade::class, 'id', 'especialidade_id');
    }

    public function getFoto() 
    {        
        return Storage::url($this->foto);
    }

    public function getTelefone()
    {
        $mask = strlen($this->telefone) === 11? "(%s%s) %s%s%s%s%s-%s%s%s%s" : "(%s%s) %s%s%s%s-%s%s%s%s";
        
        return vsprintf($mask, str_split($this->telefone));
    }
}
