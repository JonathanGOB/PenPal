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
        'chatroom_id', 'joinchat', 'private', 'owner_id', 'allow_people_id', 'roles'
    ];

    /**
     * @var array
     */
    protected $rules = [
      '', '', 'required|integer', 'required|integer', 'required|string|json', ''
    ];

    public function getrules(){
        return $this->rules;
    }

    public function grouppicture(){
        return $this->morphOne('Image', 'imageable');
    }

    public function chatusers(){
        return $this->hasMany(Chatuser::class);
    }

}
