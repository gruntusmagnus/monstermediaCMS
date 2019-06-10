<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Authenticable extends Authenticatable implements JWTSubject
{
    public $timestamps = true;
    protected $fillable = [
        'email',
        'password',
        'active',
        'authenticable_id'

    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function authenticable()
    {
        return $this->morphTo();
    }
}
