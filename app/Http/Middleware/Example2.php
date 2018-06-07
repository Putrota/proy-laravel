<?php

namespace App\Http\Middleware;

use Closure;

class Example2
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

        if(true) {

            echo 'esto es un middleware aplicado desde el controller';
            return $next($request);
            
        }

        return response('No puedes continuar', 404);

    }
}
