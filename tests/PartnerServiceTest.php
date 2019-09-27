<?php

use App\Services\PartnerService;
use App\Models\Partner;
use App\Services\GeoLocalizationService;


class PartnerServiceTest extends TestCase
{
    
    public function testOnePartnerAvailableInside10KmArea()
    {           
        $partnerList = json_decode('
            [
                {"lat": -25.475010,"long": -49.289280},
                {"lat": -25.422910,"long": -49.304970}
            ]
        ');
        $partner    = $this->createMock(Partner::class);
        $partner->method('findByServices')->willReturn($partnerList);
        
        $geoService = $this->createMock(GeoLocalizationService::class);
        $geoService->method('calculateDistance')->willReturn(4.9, 10.5);

        $ps = new PartnerService($partner, $geoService);

        $services = [];

        $lat = -25.517830;
        $long = -49.300710;
        $area = 10;

        $mylist = $ps->availableServices($services, $lat, $long, $area);

        $this->assertEquals(1, count($mylist));                
    }

    public function testThereIsNoPartnersAvailableInside10KmArea()
    {           
        $partnerList = json_decode('
            [
                {"lat": -25.475010,"long": -49.289280},
                {"lat": -25.522910,"long": -49.304970},
                {"lat": -25.622910,"long": -49.404970},
                {"lat": -25.722910,"long": -49.504970},
                {"lat": -25.822910,"long": -49.604970}
            ]
        ');
        $partner    = $this->createMock(Partner::class);
        $partner->method('findByServices')->willReturn($partnerList);
        
        $geoService = $this->createMock(GeoLocalizationService::class);
        $geoService->method('calculateDistance')->willReturn(15, 10, 10.1, 90, 11);

        $ps = new PartnerService($partner, $geoService);

        $services = [];

        $lat = -25.517830;
        $long = -49.300710;
        $area = 10;

        $partners = $ps->availableServices($services, $lat, $long, $area);

        $this->assertEquals(0, count($partners));                
    }
}