<?php

namespace App\Models;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'occupation_id', 'nationality_id', 'country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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


    public function setEmailAttribute($value){
        $this->attributes['email'] = strtolower($value);
    }

    public function getEmailAttribute($value){
        return strtolower($value);
    }

    public function avatar(){
        return $this->morphOne('Image', 'imageable');
    }

    public function friendslist(){
        return $this->hasOne(Friend::class);
    }

    public function nationality(){
        return $this->hasOne(Nationality::class);
    }

    public function country(){
        return $this->hasOne(Country::class);
    }

    public function occupation(){
        return $this->hasOne(Occupation::class);
    }

}
