<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Partner extends Model {


    /**
     * 
     * @param string $services Services list comma separated (OIL_CHANGE, DRY_WASHING)
     * @return array           Returns an array of stdClass objects
     */
    public function findByServices(array $services){
        $sql = "SELECT
                    p.name,
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
}