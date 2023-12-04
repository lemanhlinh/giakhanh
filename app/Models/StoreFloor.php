<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFloor extends Model
{
//    use HasFactory;
protected $guarded = ['id'];
protected $table = 'store_floor';
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function Store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
