<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class type_adv
{
    public function handle(Request $request, Closure $next)
    {
    
        if (auth()->user()->type !=2) 
        {
            return response()->json(['err' => 'this request for advisor only '], 201);
        }
        
        return $next($request);
    }
}
