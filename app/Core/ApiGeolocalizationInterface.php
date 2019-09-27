<?php 

namespace App\Core;



interface ApiGeolocalizationInterface {

    /**
     * The API should be able to return geo coordinates 
     * 
     * @return mixed 
     */
    public function coordinatesFromAddress(string $address);

}