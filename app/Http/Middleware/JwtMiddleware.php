<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\ExpiredException;
use Exception;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');
        if(empty($token)){
            return response()->json(['error' => 'Acesso não autorizado'], 401);
        }

        try{
            FirebaseJWT::decode($token, env('JWT_SECRET'), ['HS256']);
        }
        catch(ExpiredException $e) {
            return response()->json([ 'error' => 'O Token fornecido expirou.'], 400);
        } 
        catch(Exception $e){
            return response()->json(['error' => 'Error'], 400);
        }
        return $next($request);
    }
}
