<?php

class FakeLoginTest extends ApiTest
{
    public function testFakeLogin()
    {
        $this->login();

        $response = $this->client->get('user/me');

        $user = json_decode($response->getBody())->result;
        
        $this->assertEquals($user->first_name, 'Ronald');
    }
}
