<?php 

namespace App\Core;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\ExpiredException;
use App\Exceptions\TokenExpiredException;
use App\Core\TokenGeneratorInterface;

class JwtTokenGenerator implements TokenGeneratorInterface {

    /**
     * @var string
     */
    private $applicationName;

    public function setApplicationName(string $applicationName){
        $this->applicationName = $applicationName;
    }

    /**
     * 
     * @return string
     */
    public function create($string){
        $payload = [
            'iss' => $this->applicationName, 
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