<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag'
    ];

    public function picture(){
        return $this->morphOne('Image', 'imageable');
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function favourites(){
        return $this->morphMany('Favourite', 'favouriteable');
    }
}
