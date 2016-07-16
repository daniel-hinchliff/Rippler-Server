<?php

namespace Rippler\Models;

class User extends \Illuminate\Database\Eloquent\Model implements \JsonSerializable
{
    protected $table = 'users';

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();

        $data['picture'] = "http://graph.facebook.com/{$this->fbid}/picture?type=large";

        unset($data['birthday']);
        unset($data['email']);

        return $data;
    }
}

