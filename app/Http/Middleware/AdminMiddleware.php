<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       return(Auth::user() && Auth::user()->usertype =='1')
       ? $next($request)
       : redirect('/');
       
        // if(Auth::user() && Auth::user()->usertype =='1')
        // {
        //     return $next($request);
        // }
        // return redirect('/');
        
    }
}
