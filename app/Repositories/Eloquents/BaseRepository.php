<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\BaseInterface;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseInterface
{
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    public abstract function getModelClass(): string;

    /**
     * @param int $id
     * @param array $relationships
     * @return mixed
     */
    public function getOneById(int $id, array $relationships = [])
    {
        return $this->model->with($relationships)->findOrFail($id);
    }

    /**
     * @param array $ids
     * @return \Illuminate\Support\Collection
     */
    public function getByIds(array $ids): Collection
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->model->whereId($id)->update($attributes);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param int $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate(int $limit, array $columns = ['*'])
    {
        return $this->model->select($columns)->latest()->paginate($limit ?? config('data.limit', 20));
    }

    /**
     * @return Collection
     */
    public function getWithDepth() : Collection
    {
        return $this->model->withDepth()->defaultOrder()->get();
    }
}
