<?php

namespace App\Repositories\Contracts;

interface StoreInterface extends BaseInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);
}
