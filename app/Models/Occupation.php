<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    /**
     * @var array
     */
    protected $rules = [
        'required|string'
    ];

    /**
     * @return array
     */
    public function getrules(){
        return $this->rules;
    }

    /**
     * @return MorphOne
     */
    public function picture(){
        return $this->morphOne('Image', 'imageable');
    }

    /**
     * @return HasMany
     */
    public function users(){
        return $this->hasMany(User::class);
    }
}
