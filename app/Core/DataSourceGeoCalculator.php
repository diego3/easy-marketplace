<?php 

namespace App\Core;

use App\Core\AbstractGeoCalculator;

class DataSourceGeoCalculator extends AbstractGeoCalculator {


    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    /*::                                                                         :*/
    /*::  This routine calculates the distance between two points (given the     :*/
    /*::  latitude/longitude of those points). It is being used to calculate     :*/
    /*::  the distance between two locations using GeoDataSource(TM) Products    :*/
    /*::                                                                         :*/
    /*::  Definitions:                                                           :*/
    /*::    South latitudes are negative, east longitudes are positive           :*/
    /*::                                                                         :*/
    /*::  Passed to function:                                                    :*/
    /*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
    /*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
    /*::    unit = the unit you desire for results                               :*/
    /*::           where: 'M' is statute miles (default)                         :*/
    /*::                  'K' is kilometers                                      :*/
    /*::                  'N' is nautical miles                                  :*/
    /*::  Worldwide cities and other features databases with latitude longitude  :*/
    /*::  are available at https://www.geodatasource.com                          :*/
    /*::                                                                         :*/
    /*::  For enquiries, please contact sales@geodatasource.com                  :*/
    /*::                                                                         :*/
    /*::  Official Web site: https://www.geodatasource.com                        :*/
    /*::                                                                         :*/
    /*::         GeoDataSource.com (C) All Rights Reserved 2018                  :*/
    /*::                                                                         :*/
    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    public function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K') {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        
        $theta = $lon1 - $lon2;
        $dist  = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist  = acos($dist);
        $dist  = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit  = strtoupper($unit);
    
        if ($unit == "K") {
            return round(($miles * 1.609344), 2);
        } else if ($unit == "N") {
            return round(($miles * 0.8684), 2);
        } 
        return round($miles,2);
    }
}