<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chatroom_id'
    ];

    public function grouppicture(){
        return $this->morphOne('Image', 'imageable');
    }

    public function chatusers(){
        return $this->hasMany(Chatuser::class);
    }

}
