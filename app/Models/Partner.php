<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Core\GeoCalculator;

class Partner extends Model {


    /**
     * 
     * @param string $services Services list comma separated (OIL_CHANGE, DRY_WASHING)
     * @return array           Returns an array of stdClass objects
     */
    public static function findByServices(array $services){
        $sql = "SELECT
                    p.name as partner_name,
                    GROUP_CONCAT(s.name) as services,
                    l.address,
                    l.lat,
                    l.long
                FROM easy.partners p 
                    INNER JOIN easy.partner_services s ON s.partner_id = p.id
                    INNER JOIN easy.partner_locations l ON l.partner_id = p.id
                WHERE s.name IN(".implode(',', array_fill(0, count($services), '?')).")
                GROUP BY p.id ";

        return DB::select($sql, $services);
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
    public static function getClosestService(array $services, $lat, $long, $area = 10){
        $ret = new stdClass;
        $partners = Partner::findByServices($services);
        if(empty($partners)){
            return $ret;
        }

        $closest = 0;
        foreach($partners as &$p){
            $distance = GeoCalculator::distance($lat, $long, $p->lat, $p->long, 'K');
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
    public static function availableServices(array $services, $lat, $long, $area = 10){
        $ret = [];
        $partners = Partner::findByServices($services);
        if(empty($partners)){
            return $ret;
        }

        foreach($partners as &$p){
            $distance = GeoCalculator::distance($lat, $long, $p->lat, $p->long, 'K');
            
            if($distance < $area){
                $p->distance = $distance . ' km';
                $ret[] = $p;
            }
        }
        return $ret;
    }

}