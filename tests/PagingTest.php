<?php

class PagingTest extends ApiTest
{
    public function testPaging()
    {
        $this->clearData();
        $this->createMultipleRipples(['longitude' => 20, 'latitude' => 20], 12);

        $this->assertEquals(10, count($this->getRipples(20, 20, 10)));
        $this->assertEquals(12, count($this->getAllRipples()));
    }
}

