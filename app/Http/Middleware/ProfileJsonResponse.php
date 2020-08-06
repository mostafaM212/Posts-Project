<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class ProfileJsonResponse
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
        $response = $next($request);		//here we are reseving our request if our request is an JsonResponse and if we add to our any sending data to any url {?_debugbar}
        // it will automatic add debug bar info to our data
        if ($response instanceof JsonResponse && app('debugbar')->isEnabled() && $request->has('_debug')){

            $response->setData($response->getData(true) + [		//here we use $response->setData to send new data contains debugbar info to any url and we yse get data fun to get the data from request
                    '_debugbar'=> Arr::only(app('debugbar')->getData(),'queries')	//here we use Arr class contains many useful fun with arrays and we will get queries section from info
                ] );
        }
        return  $response ;
    }
}
