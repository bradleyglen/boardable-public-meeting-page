<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $dates = ['start', 'end'];

    public function meetings_users()
    {
        return $this->hasMany('App\Models\MeetingsUser', 'id');
    }

    public function users(){
      return $this->hasManyThrough('App\Models\MeetingsUser');
    }
}
