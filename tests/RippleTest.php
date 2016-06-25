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
}
