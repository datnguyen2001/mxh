<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySecretKey
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
        if ($request->header('seckey')===env('SECRET_KEY')){
            return $next($request);
        }else{
            return response()->json([
                'status' => 0,
                'message' => "Sai seckey!"
            ],403);
        }
    }
}
