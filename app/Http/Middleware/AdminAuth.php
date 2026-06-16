<?php 

namespace App\Http\Middleware;

use Closure;

use Session;
use Redirect;

class AdminAuth{

    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
      if(Session::get('admin_id')==""){
          return Redirect::intended('admin');
      }else {
      return $next($request);
      }
    }

}