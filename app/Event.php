<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id', 'event_name', 'event_prefecture', 'event_venue', 'event_date', 'event_starttime', 'event_artist', 'event_imageUrl', 'event_remarks'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('type')->withTimestamps();
    }

    public function participate_users()
    {
        return $this->users()->where('type', 'participate');
    }
    
    public function interested_users()
    {
        return $this->users()->where('type', 'interested');
    }
}