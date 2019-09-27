<?php 

namespace App\Core;



class ApiGeolocalizationInterface {

    /**
     * The API should be able to return geo coordinates 
     * 
     * @return mixed 
     */
    public abstract function coordinatesFromAddress(string $address);

}