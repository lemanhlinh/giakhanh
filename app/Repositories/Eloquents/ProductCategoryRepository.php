<?php

namespace App\Repositories\Eloquents;

use App\Models\ProductsCategories;
use App\Repositories\Contracts\ProductCategoryInterface;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\ProductsCategories';
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
        $file->storeAs('public/product/' . $type . '/', $fileName);

        return '/storage/product/' . $type . '/' . $fileName;
    }
}
