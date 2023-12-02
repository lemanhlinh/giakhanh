<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreFloorDesk extends Model
{
//    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'store_floor_desk';
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const TYPE_TABLE_NORMAL = 1;
    const TYPE_TABLE_VIP = 0;
    const TYPE_TYPE = [
        self::TYPE_TABLE_NORMAL => 'Bàn thường',
        self::TYPE_TABLE_VIP => 'Bàn vip'
    ];
}
