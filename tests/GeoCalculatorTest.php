<?php 

use App\Core\GeoCalculator;

class GeoCalculatorTest extends TestCase {


    public function testDistance(){
        $home = new stdClass;
        $home->lat = -25.517830;
        $home->long = -49.300710;

        $palladium = new stdClass;
        $palladium->lat = -25.475010;
        $palladium->long = -49.289280;

        $res = GeoCalculator::distance($home->lat, $home->long, $palladium->lat, $palladium->long, 'K');
        $this->assertEquals($res, 4.9);// 4.9 km
        $this->assertTrue($res < 10);

        $terminal = new stdClass;
        $terminal->lat = -25.512680;
        $terminal->long = -49.295050;
        $res = GeoCalculator::distance($home->lat, $home->long, $terminal->lat, $terminal->long, 'K');
        $this->assertEquals($res, 0.81);// 810 metros
        $this->assertTrue($res < 10);


        $barigui = new stdClass;
        $barigui->lat = -25.422910;
        $barigui->long = -49.304970;
        $res = GeoCalculator::distance($home->lat, $home->long, $barigui->lat, $barigui->long, 'K');
        // google maps = 10.77km
        $this->assertEquals($res, 10.56);//10.56 km
        $this->assertFalse($res < 10);
    }


}