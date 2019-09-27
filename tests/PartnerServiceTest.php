<?php

use App\Services\PartnerService;
use App\Models\Partner;
use App\Services\GeoLocalizationService;

class PartnerServiceTest extends TestCase
{
    
    public function testAvailablesServiceInside10KmArea()
    {   
        $home = new stdClass;
        $home->lat = -25.517830;
        $home->long = -49.300710;

        $palladium = new stdClass;
        $palladium->lat = -25.475010;
        $palladium->long = -49.289280;

        $partner    = $this->createMock(Partner::class);
                        
        $partnerList = [];
        $partnerList[] = $palladium;
        $partner->method('findByServices')->willReturn($partnerList);
        
        $geoService = $this->createMock(GeoLocalizationService::class);
        $geoService->method('calculateDistance')->willReturn(4.9);

        $ps = new PartnerService($partner, $geoService);

        $services = [];
        $lat = $home->lat;
        $long = $home->long;
        $area = 10;

        $mylist = $ps->availableServices($services, $lat, $long, $area);

        $this->assertEquals(1, count($mylist));                
    }
}