<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StoreUser extends Authenticatable implements JWTSubject
{

    use Notifiable;
//    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'store_user';
    const ROLE_ADMIN = 0;
    const ROLE_CONTENT = 1;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const TYPE_ROLE = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_CONTENT => 'Content',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isActive()
    {
        return $this->active === self::STATUS_ACTIVE;
    }

}
