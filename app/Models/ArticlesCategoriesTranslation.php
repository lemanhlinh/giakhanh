<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesCategoriesTranslation extends Model
{
    protected $table = 'articles_categories_translation';
    protected $guarded = ['id'];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const TYPE_PROMOTION = 1;
    const TYPE_ARTICLE = 0;

    public function article_category()
    {
        return $this->belongsTo(MenuCategory::class, 'article_category_id');
    }
}
