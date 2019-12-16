<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Event extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'seen', 'type', 'observable_id', 'observable_type', 'eventable_id', 'eventable_type'
    ];

    /**
     * @return MorphTo
     */
    public function observable(){
        return $this->morphTo();
    }

    /**
     * @return MorphTo
     */
    public function eventable(){
        return $this->morphTo();
    }
}
