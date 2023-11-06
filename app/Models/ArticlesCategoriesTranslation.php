<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesCategoriesTranslation extends Model
{
    protected $table = 'articles_categories_translation';
    protected $guarded = ['id'];

    public function article_category()
    {
        return $this->belongsTo(MenuCategory::class, 'article_category_id');
    }
}
