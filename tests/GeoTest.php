<?php

use \Rippler\Models\Ripple;

class GeoTest extends ApiTest
{
    const readingLatitude = 51.4562500 ;
    const readingLongitude = -0.9711300;
    const southamptonLatitude = 50.9039500;
    const southamptonLongitude = -1.4042800;

    public function setUp()
    {
        parent::setUp();

        Ripple::getQuery()->delete();

        $london_ripple = new Ripple();
        $london_ripple->radius = 70;
        $london_ripple->latitude = 51.5085300;
        $london_ripple->longitude = -0.1257400;
        $london_ripple->description = 'London';
        $london_ripple->image_path = 'dasdasd';
        $london_ripple->creation_time = '2016-05-25 00:00:00';
        $london_ripple->end_time = '2016-05-25 00:00:00';
        $london_ripple->user_id = 1;
        $london_ripple->save();

        $oxford_ripple = new Ripple();
        $oxford_ripple->radius = 45;
        $oxford_ripple->latitude = 51.752022;
        $oxford_ripple->longitude = -1.257677;
        $oxford_ripple->description = 'Oxford';
        $oxford_ripple->image_path = 'dasdasd';
        $oxford_ripple->creation_time = '2016-05-25 00:00:00';
        $oxford_ripple->end_time = '2016-05-25 00:00:00';
        $oxford_ripple->user_id = 1;
        $oxford_ripple->save();
    }

    public function getRipples($latitude, $longitude, $radius)
    {
        $response = $this->client->get("rippler/ripple/$latitude/$longitude/$radius");

        return json_decode($response->getBody());
    }

    public function testListResponseBoth()
    {
        $ripples = $this->getRipples(self::readingLatitude, self::readingLongitude, 100);
        
        $this->assertEquals(2, count($ripples));
        $this->assertEquals('London', $ripples[0]->description);
        $this->assertEquals('Oxford', $ripples[1]->description);
    }

    public function testListResponseJustOxford()
    {
        $ripples = $this->getRipples(self::readingLatitude, self::readingLongitude, 45);

        $this->assertEquals(1, count($ripples));
        $this->assertEquals('Oxford', $ripples[0]->description);
    }

    public function testListResponseNoneFromReading()
    {
        $ripples = $this->getRipples(self::readingLatitude, self::readingLongitude, 15);

        $this->assertEquals(0, count($ripples));
    }

    public function testListResponseJustNoneFromSouthampton()
    {
        $ripples = $this->getRipples(self::southamptonLatitude, self::southamptonLongitude, 200);

        $this->assertEquals(0, count($ripples));
    }
}
