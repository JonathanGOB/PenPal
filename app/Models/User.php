<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use function GuzzleHttp\Psr7\str;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const ADMIN = 1;
    const REGULAR_USER = 0;
    const MAX_PASSWORD_RESETS = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'occupation_id', 'nationality_id', 'country_id', 'active', 'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'boolean'
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * @param $value
     */
    public function setEmailAttribute($value){
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getEmailAttribute($value){
        return strtolower($value);
    }

    /**
     * @return MorphOne
     */
    public function profile_picture(){
        return $this->morphOne('Image', 'imageable');
    }

    /**
     * @return HasOne
     */
    public function friends(){
        return $this->hasOne(Friend::class);
    }

    /**
     * @return HasOne
     */
    public function nationality(){
        return $this->hasOne(Nationality::class);
    }

    /**
     * @return HasOne
     */
    public function country(){
        return $this->hasOne(Country::class);
    }

    /**
     * @return HasOne
     */
    public function occupation(){
        return $this->hasOne(Occupation::class);
    }

    /**
     * @return MorphMany
     */
    public function events(){
        return $this->morphMany('Event', 'eventable');
    }

    /**
     * @return MorphMany
     */
    public function observers(){
        return $this->morphMany('Event', 'observable');
    }

}
