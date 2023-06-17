<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id', 'id');
    }
}
