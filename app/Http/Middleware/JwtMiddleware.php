<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if($e instanceof TokenInvalidException){
                return response()->json(['message' => 'Invalid token', 'status' => 401]);
            }else if ($e instanceof TokenExpiredException){
                return response()->json(['message' => 'Expired token', 'status' => 498]);
            }else {
                return response()->json(['message' => 'Token not found', 'status' => 401]);
            }
        }
        return $next($request);
    }
}
