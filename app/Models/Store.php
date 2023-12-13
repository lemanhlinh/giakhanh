<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $guarded = ['id'];

    protected $appends = [
        'total_use',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function storeFloorDesk()
    {
        return $this->hasMany(StoreFloorDesk::class, 'store_id', 'id');
    }

    public function getTotalUseAttribute()
    {
        $desks = $this->storeFloorDesk;
        $total_use = 0;
        if ($desks) {
            foreach ($desks as $desk){
                if ($desk->status == 3){
                    $total_use++;
                }
            }
            return $total_use;
        } else {
            return $total_use;
        }
    }
}
