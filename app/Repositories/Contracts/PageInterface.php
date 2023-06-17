<?php

namespace App\Repositories\Contracts;

interface PageInterface extends BaseInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);
}
