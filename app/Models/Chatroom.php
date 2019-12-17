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
        'joinchat', 'private', 'owner_id', 'allow_people_id', 'roles', 'description'
    ];


    /**
     * @var array
     */
    protected $rules = [
      'automatic', 'required|integer', 'required|integer', 'required|string|json', 'required|string|json', 'required|string'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'private' => 'boolean'
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
