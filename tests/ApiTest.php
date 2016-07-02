<?php

/**
 * @property GuzzleHttp\Client $client
 */

abstract class ApiTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost/'
        ]);
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
}
