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
}
