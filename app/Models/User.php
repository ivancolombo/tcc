<?php

namespace App\Models;

use App\models\Medico;
use App\models\Paciente;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'tipo', 'termo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function medico()
    {
        return $this->hasOne(Medico::class);
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    
    public function search(String $tipo, Array $data)
    {
        return $this->with('medico', 'medico.especialidade')->where('tipo', $tipo)->where(function($query) use($data) {
            if (isset($data['nome']) && !is_null($data['nome']))
                $query->where('name', 'ilike', '%'.$data['nome'].'%');
            if (isset($data['especialidade']) && !is_null($data['especialidade'])) 
                $query->whereHas('medico.especialidade', function ($query) use($data) {
                    if (isset($data['especialidade']) && !is_null($data['especialidade']))
                        $query->where('especialidade_id', $data['especialidade']);
                });
        })->orderBy('name', 'asc')->paginate(3);

    }
}
