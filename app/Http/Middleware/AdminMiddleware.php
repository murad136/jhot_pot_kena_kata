<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        if (auth()->user()->is_admin == 1){
            return $next($request);
        }else{
            return redirect()->route('home')->with('error','You are not a super admin');
        }

    }
}
