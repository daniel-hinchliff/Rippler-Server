<?php

use \Rippler\Models\Swipe;
use \Rippler\Models\Ripple;

/**
 * @property GuzzleHttp\Client $client
 */

abstract class ApiTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost/',
            'cookies' => true,
        ]);
    }

    public function login()
    {
        $this->client->get("rippler/test_login");
    }

    public function getAllRipples()
    {
        $response = $this->client->get("rippler/ripple");

        return json_decode($response->getBody());
    }

    public function getRipples($latitude, $longitude, $radius)
    {
        $response = $this->client->get("rippler/ripple/$latitude/$longitude/$radius");

        return json_decode($response->getBody());
    }

    public function getMatches()
    {
        $response = $this->client->get("rippler/ripple/match");

        return json_decode($response->getBody());
    }

    public function createRipple($data)
    {
        $image = new \Rippler\Models\Image();
        $image->public_id = "test";
        $image->save();

        $data += array (
          'radius' => 23,
          'latitude' => '32',
          'longitude' => '32',
          'description' => 'ewfef',
          'end_time' => '2016-05-25 00:00:00',
          'image_id' => $image->id,
        );

        $ripple = new Ripple();
        $ripple->radius = 45;
        $ripple->description = 'Oxford';
        $ripple->latitude = $data['latitude'];
        $ripple->longitude = $data['longitude'];
        $ripple->creation_time = '2016-05-25 00:00:00';
        $ripple->end_time = '2016-05-25 00:00:00';
        $ripple->user_id = 1;
        $ripple->save();
    }

    public function createMultipleRipples($data, $quantity)
    {
        for ($i = 0; $i < $quantity; $i++)
        {
            $this->createRipple($data);
        }
    }

    public function clearData()
    {
        Swipe::getQuery()->delete();
        Ripple::getQuery()->delete();
    }
}
