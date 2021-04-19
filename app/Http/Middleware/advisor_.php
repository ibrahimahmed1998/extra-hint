<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Student_Area;
use App\Http\Controllers\Yellow_Area;
class advisor_
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
    
        if (auth()->user()->type !=2) {
            return response()->json(['error' => 'this request for advisor only '], 201);
        }
        
        return $next($request);
    }
}
