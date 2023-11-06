<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsTranslation extends Model
{
    protected $table = 'products_translation';
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Menu::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductsCategories::class, 'category_id', 'id');
    }
}
