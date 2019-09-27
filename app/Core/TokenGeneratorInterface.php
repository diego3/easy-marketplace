<?php 

namespace App\Core;


class TokenGeneratorInterface {

    /**
     * Creates a new token
     */
    public abstract function create($string);

    /**
     * Check if a token is valid
     */
    public abstract function verify($token);
}