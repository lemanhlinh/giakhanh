<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface BaseInterface
{
    /**
     * @return string
     */
    public function getModelClass(): string;

    /**
     * @param int $id
     * @param array $relationships
     * @return mixed
     */
    public function getOneById(int $id, array $relationships = []);

    /**
     * @param array $ids
     * @return Collection
     */
    public function getByIds(array $ids): Collection;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @param int $limit
     * @param array $column
     * @return mixed
     */
    public function paginate(int $limit, array $column = ['*']);

    /**
     * @return Collection
     */
    public function getWithDepth(): Collection;

    /**
     * @param array $where
     * @param array $column
     * @param array $relationships
     * @param int $limit
     * @return mixed
     */
    public function getList(array $where, array $column = ['*'], int $limit, array $relationships = []);
}
