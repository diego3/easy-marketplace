<?php 

namespace App\Services;

use App\Services\GeoLocalizationService;
use App\Core\DataSourceGeoCalculator;

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