<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Friend extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'friends_list'
    ];

    /**
     * @return HasOne
     */
    public function user(){
        return $this->hasOne(User::class);
    }
}
