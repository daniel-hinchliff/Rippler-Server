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

    public function testPostRippleWithImage()
    {
        $image = new \Rippler\Models\Image();
        $image->public_id = "test";
        $image->save();
        
        $data = array (
          'radius' => 23,
          'latitude' => '32',
          'longitude' => '32',
          'description' => 'ewfef',
          'end_time' => '2016-05-25 00:00:00',
          'image_id' => $image->id,
        );

        $response = $this->client->post('rippler/ripple?XDEBUG_SESSION_START=netbeans-xdebug', ['json' => $data]);

        $ripple = json_decode($response->getBody());
        
        $this->assertEquals($image->id, $ripple->image_id);
        $this->assertEquals($ripple->user_id, 1);
        $this->assertNotEmpty($ripple->image_url);
        $this->assertNotEmpty($ripple->id);
    }

    public function testPostRippleWithoutImage()
    {
        $data = array (
          'radius' => 23,
          'latitude' => '32',
          'longitude' => '32',
          'description' => 'ewfef',
          'image_path' => 'ewfef',
          'end_time' => '2016-05-25 00:00:00',
        );

        $response = $this->client->post('rippler/ripple?XDEBUG_SESSION_START=netbeans-xdebug', ['json' => $data]);

        $ripple = json_decode($response->getBody());

        $this->assertEmpty($ripple->image_id);
        $this->assertEmpty($ripple->image_url);
        $this->assertNotEmpty($ripple->id);
    }
}
