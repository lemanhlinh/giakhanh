<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTable extends Model
{
//    use HasFactory;
    protected $table = 'books_table';
    protected $guarded = ['id'];

    const TYPE_WAIT = 1;
    const TYPE_SUCCESS = 2;
    const TYPE_CANCER = 3;

    const TYPE = [
        self::TYPE_WAIT => 'Đợi xử lý',
        self::TYPE_SUCCESS => 'Thành công',
        self::TYPE_CANCER => 'Hủy',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function floorDesk()
    {
        return $this->belongsTo(StoreFloorDesk::class, 'store_id', 'id');
    }

    public function StoreDeskOrder()
    {
        return $this->hasMany(StoreDeskOrder::class,'book_table_id','id');
    }
}
