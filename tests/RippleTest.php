<?php

class RippleTest extends ApiTest
{
    const JsonFormat = 'application/json;charset=utf-8';

    public function testListResponse()
    {
        $response = $this->client->get('rippler/ripple');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(self::JsonFormat, $response->getHeader('Content-Type')[0]);
    }

    public function testPostRipple()
    {
        $data = array (
          'radius' => 23,
          'latitude' => '32',
          'longitude' => '32',
          'description' => 'ewfef',
          'image_path' => 'dasdasd',
          'end_time' => '2016-05-25 00:00:00',
        );

        $response = $this->client->post('rippler/ripple?XDEBUG_SESSION_START=netbeans-xdebug', ['json' => $data]);

        $ripple = json_decode($response->getBody());

        $this->assertNotEmpty($ripple->id);
    }
}
