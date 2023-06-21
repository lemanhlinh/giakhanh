<?php

namespace App\Repositories\Eloquents;

use App\Models\Product;
use App\Repositories\Contracts\ProductInterface;

class ProductRepository extends BaseRepository implements ProductInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return 'App\Models\Product';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        if (\request()->hasFile('image')) {
            $data['image'] = $this->saveFileUpload($data['image'], 'images');
        }

        return $this->create($data);
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
