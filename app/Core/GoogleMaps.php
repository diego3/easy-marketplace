<?php 

namespace App\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleHttpRequest;

class GoogleMaps {


    const GOOGLE_MAPS = 'https://maps.googleapis.com/maps/api/';
    
    /**
     * Get the distance between two points of localization
     * 
     * @param string $origins       It can be a geolocalization points or an address
     * @param string $destinations  It can be a geolocalization points or an address
     * 
     * @return string               Returns a json string containing detailed information about the coordinates
     */
    public static function distanceMatrix($origins, $destinations){ 
        $params = [
            'origins' =>  $origins,
            'destinations' =>  $destinations,
            'key' => env('GOOGLE_MAPS_API_KEY')
        ];

        $client = new Client(['base_uri' => self::GOOGLE_MAPS]);
        $response = $client->request('GET', 'distancematrix/json', [
            'query' => $params
        ]);

        return $response->getBody()->getContents();
    }


}