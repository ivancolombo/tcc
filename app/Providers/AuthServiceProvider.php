<?php

namespace App\Providers;

use App\models\Consulta;
use App\Models\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // $gate->before(function(User $user, $ability){            
        //     if($user->tipo == 'admin') {
        //         return true;
        //     }            
        // });

        $gate->define('admin', function(User $user) {
            if($user->tipo == 'admin') {
                return true;
            }
            return false;
        });

        $gate->define('medico', function(User $user) {
            if($user->tipo == 'medico') {
                return true;
            }
            return false;
        });

        $gate->define('paciente', function(User $user) {
            if($user->tipo == 'paciente') {
                return true;
            }
            return false;
        });

        $gate->define('secretaria', function(User $user) {
            if($user->tipo == 'secretaria') {
                return true;
            }
            return false;
        });

        $gate->define('gerenciar-paciente', function(User $user) {
            if($user->tipo == 'secretaria' || $user->tipo == 'admin') {
                return true;
            }
            return false;
        });

        $gate->define('permissao-consulta', function(User $user, Consulta $consulta) {
            
            if((($user->tipo === 'paciente' && $consulta->paciente_id === $user->id) || ($user->tipo === 'medico' && $consulta->medico_id === $user->id)) 
                && (date('Y-m-d H:i', strtotime("+10 minutes", strtotime("now"))) >= date('Y-m-d H:i', strtotime($consulta->data)) 
                && date('Y-m-d H:i', strtotime("-30 minutes", strtotime("now"))) <= date('Y-m-d H:i', strtotime($consulta->data)) 
                && $consulta->status === false )) {
                return true;
            }
            return false;
        });

    }
}
