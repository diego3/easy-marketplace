<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\GoogleMapsApi;

class GeoController extends Controller
{
    
    
    public function distance(Request $request)
    {     
        $origins      = $request->input('origins');
        $destinations = $request->input('destinations');
         
        return (new GoogleMapsApi())->distanceMatrix($origins, $destinations);
    }
}
