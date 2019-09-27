<?php 

namespace App\Services;



class GeoLocalizationService {

    protected $calculator;

    public function __construct(GeoCalculator $geoCalculator)
    {
        $this->calculator = $geoCalculator;
    }
    
    public function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit = 'K'){

        return $this->calculator->distance($lat1, $lon1, $lat2, $lon2, $unit);
    }

}