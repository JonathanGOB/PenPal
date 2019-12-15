<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatuser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chatroom_id', 'user_id'
    ];

    public function chatroom(){
        return $this->hasOne(Chatroom::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
