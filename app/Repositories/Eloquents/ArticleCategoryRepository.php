<?php

namespace App\Repositories\Eloquents;

use App\Models\ArticlesCategories;
use App\Repositories\Contracts\ArticleCategoryInterface;

class ArticleCategoryRepository extends BaseRepository implements ArticleCategoryInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\ArticlesCategories';
    }

    /**
     * @param $file
     * @param $type
     * @return string
     */
    public function saveFileUpload($file, $type)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '-' . rand(1, 999) . '.' . $extension;
        $file->storeAs('public/article/' . $type . '/', $fileName);

        return '/storage/article/' . $type . '/' . $fileName;
    }
}
