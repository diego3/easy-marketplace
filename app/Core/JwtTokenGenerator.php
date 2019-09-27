<?php 

namespace App\Core;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\ExpiredException;
use App\Exceptions\TokenExpiredException;
use App\TokenGeneratorInterface;

class JwtTokenGenerator implements TokenGeneratorInterface {


    /**
     * 
     * @return string
     */
    public function create($string){
        $payload = [
            'iss' => "easy-marketplace-api", 
            'sub' => $string,
            'iat' => time(),
            'exp' => time() + 60*60 // in seconds 
        ];

        return FirebaseJWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    /**
     * 
     * @throws Exception | App\Exception\TokenExpiredException
     */
    public function verify($token){
        try{
            FirebaseJWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            throw new TokenExpiredException('O Token fornecido expirou.', 400);
        } 
    }

}