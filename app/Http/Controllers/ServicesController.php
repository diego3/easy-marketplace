<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Core\GoogleMaps;

class ServicesController extends Controller {

    
    public function search(Request $request){
        $this->validate($request, [
            'lat'  => 'required',
            'long' => 'required',
            'services' => 'required'
        ]);

        $lat      = $request->input('lat');
        $long     = $request->input('long');
        $services = $request->input('services');
             
        $service = Partner::getClosestService($services, $lat, $long, 10);
        
        if(empty($service)){
            return response()->json(['error' => 'Nenhum serviço disponível próximo ao endereço informado'], 404);
        }
        return response()->json($service);
    }

    public function servicesList(Request $request){
        $this->validate($request, [
            'address'  => 'required',
            'services' => 'required'
        ]);

        $address  = $request->input('address');
        $services = $request->input('services');

        $response = GoogleMaps::coordinatesFromAddress($address);
        if(empty($response)){
            return response()->json(['error' => 'coordinates not found'], 404);
        }
             
        $services = Partner::availableServices($services, $response->lat, $response->lng, 10);
        
        if(empty($services)){
            return response()->json([], 400);
        }
        return response()->json($services);
    }


}