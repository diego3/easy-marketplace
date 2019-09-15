<?php 

namespace App\Core;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\ExpiredException;

class Jwt {


    /**
     * 
     * @return string
     */
    public static function getToken($user_id){
        $payload = [
            'iss' => "easy-marketplace-api", 
            'sub' => $user_id, 
            'iat' => time(),
            'exp' => time() + 60*60 // in seconds 
        ];

        return FirebaseJWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }


}