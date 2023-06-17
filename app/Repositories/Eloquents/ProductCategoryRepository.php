<?php

namespace App\Repositories\Eloquents;

use App\Models\ArticlesCategories;
use App\Repositories\Contracts\ArticleCategoryInterface;

class ProductCategoryRepository extends BaseRepository implements ArticleCategoryInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\ArticlesCategories';
    }
}
