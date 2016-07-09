<?php

namespace Rippler\Models;

class Ripple extends \Illuminate\Database\Eloquent\Model implements \JsonSerializable
{
    public $timestamps = false;
    
    protected $table = 'ripples';

    public function swipes()
    {
        return $this->hasMany('Rippler\Models\Swipe');
    }
    
    public function image()
    {
        return $this->belongsTo('Rippler\Models\Image');
    }

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();

        if (!empty($this->image_id))
        {
            $data['image_url'] = cloudinary_url($this->image->public_id);
        }
        else
        {
            $data['image_url'] = '';
        }

        return $data;
    }
}

