<?php 

namespace App\Core;


abstract class AbstractGeoCalculator {

    
    public abstract function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K');
}