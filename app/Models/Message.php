<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message', 'user_id', 'seen'
    ];

    /**
     * @var array
     */
    protected $casts = [
      'seen' => 'boolean'
    ];

    /**
     * @return HasOne
     */
    public function user(){
        return $this->hasOne(User::class);
    }

}
