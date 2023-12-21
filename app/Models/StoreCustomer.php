<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCustomer extends Model
{
//    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'store_customer';

    public function StoreDeskOrder()
    {
        return $this->hasMany(StoreDeskOrder::class,'customer_id','id');
    }
}
