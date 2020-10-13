<?php

namespace App\Http\Middleware;

use Closure;

class MessageMiddleware
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
      if (!session()->has('send')) {
             return redirect('/showmessages');
          }
        return $next($request);
    }
}
