<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'favourite', 'favouriteable_id', 'favouriteable_type'
    ];

    public function picture(){
        return $this->morphOne('Image', 'imageable');
    }

    public function favouriteable(){
        return $this->morphTo();
    }
}
