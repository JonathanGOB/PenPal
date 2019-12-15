<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'occupation'
    ];

    public function picture(){
        return $this->morphOne('Image', 'imageable');
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
