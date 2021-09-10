<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AutenticadorAdm
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

            if(!Auth::check()){
                return redirect()->route('login_adm');
            }

            if(Auth::user()->adm == 0){
                return redirect()->route('login_adm');
            }

            return $next($request);
    }
}
