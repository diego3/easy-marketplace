<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\GoogleMaps;

class GeoController extends Controller
{
    
    
    public function distance(Request $request)
    {     
        $token = $request->header('token');
        
        $origins      = $request->input('origins');
        $destinations = $request->input('destinations');
         
        $data = GoogleMaps::distanceMatrix($origins, $destinations);

        //return response()->json($response->getBody()->getContents());
        return $data;
    }
}
