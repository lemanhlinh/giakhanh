<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreUser extends Model
{
//    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'store_user';
}
