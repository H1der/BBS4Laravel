<?php

namespace App;

use App\Model;
use App\User;

class Fan extends Model
{
    //粉丝用户
    public function fuser()
    {
        return $this->hasOne(User::class, 'id', 'fan_id');
    }

    //被关注用户
    public function suser()
    {
        return $this->hasOne(User::class, 'id', 'star_id');
    }
}
