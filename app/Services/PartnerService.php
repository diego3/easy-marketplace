<?php 

namespace App\Services;

use App\Models\Partner;
use App\Services\GeoLocalizationFactory;

class PartnerService {

    /**
     * @var \App\Model\Partner
     */
    protected $partner;

    public function __construct(Partner $partner)
    {
        $this->partner = $partner;
    }

    /**
     * Find the closest available service 
     * 
     * @param array   $services  A list of services to search (OIL_CHANGE, DRY_WASHING)
     * @param numeric $lat       Latitude origin
     * @param numeric $long      Longituge origin
     * @param numeric $area      Area to search for available services (in KM)
     * 
     * @return stdClass          The closest partner service
     */
    public function getClosestService(array $services, $lat, $long, $area = 10){
        $ret = new \stdClass;
        $partners = $this->partner->findByServices($services);
        if(empty($partners)){
            return $ret;
        }
        
        $geoService = GeoLocalizationFactory::createService();
        
        $closest = (float)$area;
        foreach($partners as &$p){
            $distance = $geoService->calculateDistance($lat, $long, $p->lat, $p->long, 'K');
            $p->distance = $distance . ' km';
            
            if($distance < $area && $distance < $closest){
                $closest = $distance;
                $ret = $p;
            }
        }

        return $ret;
    }


     /**
     * Find available services 
     * 
     * @param array   $services  A list of services to search (OIL_CHANGE, DRY_WASHING)
     * @param numeric $origin    The origin address
     * @param numeric $area      Area to search for available services (in KM)
     * 
     * @return array             Return a list of available services inside that area
     */
    public function availableServices(array $services, $lat, $long, $area = 10){
        $ret = [];
        $partners = $this->partner->findByServices($services);
        if(empty($partners)){
            return $ret;
        }

        $geoService = GeoLocalizationFactory::createService();

        foreach($partners as &$p){
            $distance = $geoService->calculateDistance($lat, $long, $p->lat, $p->long, 'K');
            
            if($distance < $area){
                $p->distance = $distance . ' km';
                unset($p->lat);
                unset($p->long);
                $ret[] = $p;
            }
        }
        return $ret;
    }
}