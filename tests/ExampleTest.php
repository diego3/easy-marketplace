<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}

/*



{
  "destination_addresses": [
    "Tv. Prof. Antônio Rangel Bandeira, 2 - Pinheiros, São Paulo - SP, 05415-100, Brazil"
  ],
  "origin_addresses": [
    "Av. Pref. Acácio Garibaldi São Thiago, 2410, Florianópolis - SC, 88062-600, Brazil"
  ],
  "rows": [
    {
      "elements": [
        {
          "distance": {
            "text": "702 km",
            "value": 702407
          },
          "duration": {
            "text": "9 hours 11 mins",
            "value": 33053
          },
          "status": "OK"
        }
      ]
    }
  ],
  "status": "OK"
}



*/
