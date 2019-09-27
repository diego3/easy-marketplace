<?php 

namespace App\Services;

use App\Core\AbstractGeoCalculator;

class GeoLocalizationService {

    /**
     * @var App\Core\AbstractGeoCalculator
     */
    protected $calculator;

    public function __construct(AbstractGeoCalculator $geoCalculator)
    {
        $this->calculator = $geoCalculator;
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit = 'K'){

        return $this->calculator->distance($lat1, $lon1, $lat2, $lon2, $unit);
    }

}