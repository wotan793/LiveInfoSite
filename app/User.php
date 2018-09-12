<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function events_user()
    {
        return $this->belongsToMany(Event::class)->withPivot('type')->withTimestamps();
    }

    public function participate_events()
    {
        return $this->events_user()->where('type', 'participate');
    }
    
    public function interested_events()
    {
        return $this->events_user()->where('type', 'interested');
    }
    
    public function participate($event_id)
    {
        $this->uninterested($event_id);
        // 既に participate しているかの確認
        $exist = $this->is_participating($event_id);
        if ($exist) {
            // 既にparticipateしている場合はそのまま
            return false;
        } else {
            // 未 participateであれば participate する
            $this->events_user()->attach($event_id, ['type' => 'participate']);
            return true;
        }
    }
    
    public function interested($event_id)
    {
        $this->unparticipate($event_id);
        // 既に interested しているかの確認
        $exist = $this->is_interesting($event_id);

        if ($exist) {
            // 既にinterested している場合はそのまま
            return false;
        } else {
            // 未 interested であれば interested する
            $this->events_user()->attach($event_id, ['type' => 'interested']);
            return true;
        }
        
    }
    
    public function unparticipate($event_id)
    {
        // 既に participate しているかの確認
        $exist_participate = $this->is_participating($event_id);

        if ($exist_participate) {
            // 既に participate していれば削除する
            \DB::delete("DELETE FROM event_user WHERE user_id = ? AND event_id = ? AND type = 'participate'", [$this->id, $event_id]);
            return true;
        } else {
            // 未 participateであれば そのまま
            return false;
        }
    }
    
    public function uninterested($event_id)
    {
        // 既に interested しているかの確認
        $exist = $this->is_interesting($event_id);

        if ($exist) {
            // 既にinterested している場合は削除する
            \DB::delete("DELETE FROM event_user WHERE user_id = ? AND event_id = ? AND type = 'interested'", [$this->id, $event_id]);
            return true;
        } else {
            // 未 interested であれば そのまま
        }
        
    }
    
    public function is_participating($event_id)
    {
            $event_id_exists = $this->participate_events()->where('event_id', $event_id)->exists();
            return $event_id_exists;
    }
    
    public function is_interesting($event_id)
    {
            $event_id_exists = $this->interested_events()->where('event_id', $event_id)->exists();
            return $event_id_exists;
    }

}
