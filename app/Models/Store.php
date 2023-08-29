<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $guarded = ['id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
