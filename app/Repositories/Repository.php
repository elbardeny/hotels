<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryContract
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function where(string $column, string $value): ?Model
    {
        return $this->model->query()->where($column, $value)->first();
    }

    public function create(array $data): Model
    {
        return $this->model->query()->create($data);
    }

    public function find(int $id): ?Model
    {
        return $this->model->query()->find($id);
    }

    public function with(array $relations): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model->with($relations);
    }
}
