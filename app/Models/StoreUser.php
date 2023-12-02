<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreUser extends Model
{
//    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'store_user';
    const ROLE_ADMIN = 0;
    const ROLE_CONTENT = 1;

    const TYPE_ROLE = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_CONTENT => 'Content',
    ];

}
