<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreDeskOrder extends Model
{
//    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'store_desk_order';

    protected $appends = [
        'title',
        'price',
        'image',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function getTitleAttribute()
    {
        $title = $this->products->title;
        return $title;
    }

    public function getPriceAttribute()
    {
        return $this->products->price;
    }

    public function getImageAttribute()
    {
        return $this->products->image;
    }
}
