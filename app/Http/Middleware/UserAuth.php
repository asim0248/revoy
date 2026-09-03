<?php 

namespace App\Http\Middleware;

use Closure;

use Session;
use Redirect;

class UserAuth{

    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
      if(Session::get('user_id')==""){
          return Redirect::intended('/login');
      }else {
      return $next($request);
      }
    }

}