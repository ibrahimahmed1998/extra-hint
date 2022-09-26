<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class type_s
{
    public function handle(Request $request, Closure $next)
    {

        // if (auth()->user()->type !=1) 
        // {
        //     return response()->json(['err' => 'this request for Student only '], 201);
        // }
        return $next($request);
    }
}
