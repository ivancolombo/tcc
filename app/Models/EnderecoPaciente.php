<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class EnderecoPaciente extends Model
{
    protected $table = 'enderecos_pacientes';
    public $timestamps = false;
    protected $fillable = ['cep', 'estado', 'cidade', 'bairro', 'rua'];

    public function getCep()
    {
        $mask = "%s%s%s%s%s-%s%s%s";
        
        return vsprintf($mask, str_split($this->cep));
    }
}
