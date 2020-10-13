<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
          // $id=Auth::User()->id;
          // $user=User::find($id);
          // if (Image::find('')) {
          //   // code...
          // }
          // Image::create(['imageable_id'=>$id,'path'=>'/images/user.png','imageable_type'=>'App\User']);
            return redirect('/home');
        }

        return $next($request);
    }
}
