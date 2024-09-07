<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){

            if(auth()->user()->banned_at !== NULL){
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerate();
                return redirect(route('login'))->with('error', 'Banned ka tanga');
            }
        }
        return $next($request);
    }
}
