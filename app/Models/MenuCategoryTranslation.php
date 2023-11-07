<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategoryTranslation extends Model
{
//    use HasFactory;
    protected $table = 'menu_categories_translation';
    protected $guarded = ['id'];

    public function menu_category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
}
