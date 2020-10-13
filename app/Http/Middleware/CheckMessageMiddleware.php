<?php

namespace App\Http\Middleware;

use Closure;

class CheckMessageMiddleware
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
      if (condition) {
        // code...
      }
        return $next($request);
    }
}
