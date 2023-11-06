<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesTranslation extends Model
{
    protected $table = 'articles_translation';
    protected $guarded = ['id'];

    public function article()
    {
        return $this->belongsTo(Menu::class, 'article_id');
    }

    public function category()
    {
        return $this->belongsTo(ArticlesCategories::class, 'category_id', 'id');
    }
}
