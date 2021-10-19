<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTermo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (($user->tipo === 'paciente' || $user->tipo === 'medico') && $user->termo === false) {            
            return redirect('/termos');
        }

        return $next($request);
    }
}
