<?php 

namespace App\Core;


interface TokenGeneratorInterface {

    /**
     * Creates a new token
     */
    public function create($string);

    /**
     * Check if a token is valid
     */
    public function verify($token);
}