<?php 

namespace App\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleHttpRequest;

class GoogleMaps {


    const GOOGLE_MAPS = 'https://maps.googleapis.com/maps/api/';
    
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