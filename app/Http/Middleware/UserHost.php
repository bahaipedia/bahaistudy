<?php

namespace App\Http\Middleware;

use Closure;

class UserHost
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
        if ((auth()->user()->role == 2 || auth()->user()->role == 1) && (auth()->check() || auth()->viaRemember())) {
            return $next($request);
        }else{
            return redirect()->route('welcome');
        }
    }
}
