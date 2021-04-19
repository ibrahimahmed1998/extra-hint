<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class admin_
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
    
        if (auth()->user()->type !=3) {
            return response()->json(['error' => 'this request for admin only '], 201);
        }
        
        return $next($request);
    }
}
