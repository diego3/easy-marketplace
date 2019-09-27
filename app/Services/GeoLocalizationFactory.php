<?php 

namespace App\Services;

use App\Core\GeoCalculator;
use App\Services\GeoLocalizationService;

class GeoLocalizationFactory {


    /**
     *  
     * @return \App\Services\GeoLocalizationService
     */
    public static function createService(){
        $calculator = new DataSourceGeoCalculator();
        return new GeoLocalizationService($calculator);
    }


}