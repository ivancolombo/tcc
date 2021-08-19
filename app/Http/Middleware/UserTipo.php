<?php

namespace App\Http\Middleware;

use Closure;

class UserTipo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$tipos)
    {
        return collect($tipos)->contains(auth()->user()->tipo) ? $next($request) : redirect('/');
        // return $next($request);
    }
}
