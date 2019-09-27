<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\GoogleMaps;

class GeoController extends Controller
{
    
    
    public function distance(Request $request)
    {     
        $origins      = $request->input('origins');
        $destinations = $request->input('destinations');
         
        $data = (new GoogleMaps())->distanceMatrix($origins, $destinations);

        return $data;
    }
}
