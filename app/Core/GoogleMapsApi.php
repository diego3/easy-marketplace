<?php 

namespace App\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleHttpRequest;
use App\Core\ApiGeolocalizationInterface;

class GoogleMapsApi implements ApiGeolocalizationInterface {


    const GOOGLE_MAPS = 'https://maps.googleapis.com/maps/api/';
    
    /**
     * Get the distance between two points of localization
     * 
     * @param string $origins       It can be a geolocalization points or an address
     * @param string $destinations  It can be a geolocalization points or an address
     * 
     * @return string               Returns a json string containing detailed information about the coordinates
     */
    public function distanceMatrix($origins, $destinations){ 
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


    /**
     * Convert addresses (like a street address) into geographic coordinates
     * 
     * @param string $address  The address to convert from
     * 
     * @return \stdClass|null
     */
    public function coordinatesFromAddress(string $address){
        $params = [
            'address' =>  $address,
            'key' => env('GOOGLE_MAPS_API_KEY')
        ];

        $client = new Client(['base_uri' => self::GOOGLE_MAPS]);
        $response = $client->request('GET', 'geocode/json', [
            'query' => $params
        ]);

        $json = json_decode($response->getBody()->getContents());

        if($json->status != "OK"){
            return null;
        }

        $location = $json->results[0]->geometry->location ?? null;
       
        return $location;
    }

}