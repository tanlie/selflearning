<?php

namespace App\Http\Middleware;

use Closure;
use Mockery\Exception;

class AgeMiddleware
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
        if($request->input('age') < 18) {

            throw new Exception('EROOR');
        }
        return $next($request);
    }
}
