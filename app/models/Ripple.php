<?php

namespace Rippler\Models;

class Ripple extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    
    protected $table = 'ripples';

    public function swipes()
    {
        return $this->hasMany('Rippler\Models\Swipe');
    }
}

