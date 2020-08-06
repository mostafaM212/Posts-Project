<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth ;
class AdminMiddleware
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
        if (Auth::check() && Auth::user()->admin === 'admin'){
            return $next($request);
        }elseif (Auth::check() && Auth::user()->admin === 'user'){
            return response()->json('make sure that you are an admin',404) ;
        }else {
            return response()->json('make sure that you are authinticated',401) ;
        }
    }
}
