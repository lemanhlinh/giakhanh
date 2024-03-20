<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsTranslation extends Model
{
    protected $table = 'products_translation';
    protected $guarded = ['id'];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const IS_HOME = 1;
    const IS_NOT_HOME = 0;

    public function product()
    {
        return $this->belongsTo(Menu::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductsCategories::class, 'category_id', 'id');
    }

    public function categoryTranslation()
    {
        return $this->belongsTo(ProductsCategoriesTranslation::class, 'category_id', 'product_category_id');
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
}
