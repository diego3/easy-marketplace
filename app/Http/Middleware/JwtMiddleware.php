<?php

namespace App\Http\Middleware;

use App\Core\JwtTokenGenerator;
use Closure;
use App\Exceptions\TokenExpiredException;
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
            $tokenGenerator = new JwtTokenGenerator();
            $tokenGenerator->verify($token);
        }
        catch(TokenExpiredException $e) {
            return response()->json([ 'error' => 'O Token fornecido expirou.'], 400);
        } 
        catch(Exception $e){
            return response()->json(['error' => 'Acesso não autorizado'], 401);
        }
        return $next($request);
    }
}
