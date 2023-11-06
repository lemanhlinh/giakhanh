<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCategoriesTranslation extends Model
{
    protected $table = 'products_categories_translation';
    protected $guarded = ['id'];

    public function product_category()
    {
        return $this->belongsTo(Menu::class, 'product_category_id');
    }
}
