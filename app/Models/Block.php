<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'blocked_user_id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
