<?php

namespace App\Providers;

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

    }
}
