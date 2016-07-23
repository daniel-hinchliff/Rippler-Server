<?php

use \Rippler\Models\Swipe;
use \Rippler\Models\Ripple;

class SwipeTest extends ApiTest
{
    const oxfordLatitude = 51.752022;
    const oxfordLongitude = -1.257677;

    protected $ripple_id;

    public function setUp()
    {
        parent::setUp();

        $this->clearData();

        $oxford_ripple = new Ripple();
        $oxford_ripple->radius = 45;
        $oxford_ripple->latitude = 51.752022;
        $oxford_ripple->longitude = -1.257677;
        $oxford_ripple->description = 'Oxford';
        $oxford_ripple->creation_time = '2016-05-25 00:00:00';
        $oxford_ripple->end_time = '2016-05-25 00:00:00';
        $oxford_ripple->user_id = 1;
        $oxford_ripple->save();

        $swipe_like = new Swipe();
        $swipe_like->ripple_id = $oxford_ripple->id;
        $swipe_like->like = true;
        $swipe_like->user_id = 2;
        $swipe_like->save();

        $swipe_not_like = new Swipe();
        $swipe_not_like->ripple_id = $oxford_ripple->id;
        $swipe_not_like->like = false;
        $swipe_not_like->user_id = 3;
        $swipe_not_like->save();

        $this->ripple_id = $oxford_ripple->id;

        $this->login();
    }

    public function swipeRipple($ripple_id, $like)
    {
        $data = array (
          'like' => $like,
          'ripple_id' => $ripple_id,
        );

        $this->client->post('rippler/swipe?XDEBUG_SESSION_START=netbeans-xdebug', ['json' => $data]);
    }

    public function testNotGetUnswipedRipple()
    {
        $ripples = $this->getRipples(self::oxfordLatitude, self::oxfordLongitude, 100);
        $matches = $this->getMatches();

        $this->assertEquals(1, count($ripples));
        $this->assertEquals(0, count($matches));
    }

    public function testNotGetUnlikedRipple()
    {
        $this->swipeRipple($this->ripple_id, false);

        $ripples = $this->getRipples(self::oxfordLatitude, self::oxfordLongitude, 100);
        $matches = $this->getMatches();

        $this->assertEquals(0, count($ripples));
        $this->assertEquals(0, count($matches));
    }

    public function testNotGetLikedRipple()
    {
        $this->swipeRipple($this->ripple_id, true);

        $ripples = $this->getRipples(self::oxfordLatitude, self::oxfordLongitude, 100);
        $matches = $this->getMatches();

        $this->assertEquals(0, count($ripples));
        $this->assertEquals(1, count($matches));
    }
}
