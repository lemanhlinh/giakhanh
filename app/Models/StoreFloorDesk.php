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
    const STATUS_INACTIVE = 1;
    const TYPE_TABLE_NORMAL = 0;
    const TYPE_TABLE_VIP = 0;
    const TYPE_TYPE = [
        self::TYPE_TABLE_NORMAL => 'Bàn thường',
        self::TYPE_TABLE_VIP => 'Bàn vip'
    ];

    const CUSTOMER_NONE = 1;
    const CUSTOMER_COME = 2;
    const CUSTOMER_USE = 3;

    const CUSTOMER_STATUS = [
        self::CUSTOMER_NONE => 'Chưa có khách',
        self::CUSTOMER_COME => 'Đang đến',
        self::CUSTOMER_USE => 'Đang dùng',
    ];

    protected $appends = [
        'check_use',
    ];

    public function Store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function StoreFloor()
    {
        return $this->belongsTo(StoreFloor::class,'store_floor_id','id');
    }

    public function StoreCustomer()
    {
        return $this->hasMany(StoreCustomer::class,'table_id','id');
    }

    public function StoreCustomerUse()
    {
        return $this->hasOne(StoreCustomer::class,'table_id','id')->where(['use_table' => 1, 'type_payment' => 2])->orderBy('use_table','ASC');
    }

    public function StoreCustomerHistory()
    {
        return $this->hasMany(StoreCustomer::class,'table_id','id')->where(['use_table' => 3])->orderBy('id','DESC');
    }

    public function getCheckUseAttribute()
    {
        $customers = $this->StoreCustomer;
        if (count($customers) > 0){
            if ($customers && $customers->contains('use_table', 1)) {
                return self::CUSTOMER_USE;
            }elseif ($customers && $customers->contains('use_table', 2)){
                return self::CUSTOMER_COME;
            }else{
                return self::CUSTOMER_NONE;
            }
        }else{
            return self::CUSTOMER_NONE;
        }
    }
}
