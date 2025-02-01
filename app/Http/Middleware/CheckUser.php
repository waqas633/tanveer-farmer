<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //Session::get('user');
        $usd=session()->get('user');
        echo $usd;
        echo "Middle ware is implemented successfully";
         if(session()->has('user')){
        return redirect('welcome');
    }
        return $next($request);
    }
}
