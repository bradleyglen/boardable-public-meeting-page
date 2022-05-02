<?php

namespace App\Models;

use App\Models\User;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingsUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function meetings()
    {
        return $this->belongsTo('App\Models\Meeting', 'meeting_id');
    }
}
