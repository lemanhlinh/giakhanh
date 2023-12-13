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

//    const STATUS = [
//        self::TYPE_WAIT => 'Đợi xử lý',
//        self::TYPE_SUCCESS => 'Thành công',
//        self::TYPE_CANCER => 'Hủy',
//    ];

    public function Store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function StoreFloor()
    {
        return $this->belongsTo(StoreFloor::class,'store_floor_id','id');
    }

    public function BookTable()
    {
        return $this->hasMany(BookTable::class,'table_id','id');
    }
}
