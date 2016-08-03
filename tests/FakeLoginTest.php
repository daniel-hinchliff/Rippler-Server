<?php

class FakeLoginTest extends ApiTest
{
    public function testFakeLogin()
    {
        $this->login();

        $response = $this->client->get('rippler/user/me?XDEBUG_SESSION_START=netbeans-xdebug');

        $user = json_decode($response->getBody())->result;
        
        $this->assertEquals($user->first_name, 'Ronald');
    }
}
