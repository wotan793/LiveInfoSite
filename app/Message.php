<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['id', 'user_id', 'event_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }    
}
