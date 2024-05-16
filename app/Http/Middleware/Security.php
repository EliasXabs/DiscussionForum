<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Security
{
   public function handle(Request $request, Closure $next): Response
   {
    if(Auth::check()){
    if(Auth::user()->usertype === 'admn'){
        return $next($request);
    }else{
        abort(401, 'Unauthorized - Not an admin');
    }
    }else{
        abort(401, 'Unauthorized - Not authenticated');
    }
   }
}
