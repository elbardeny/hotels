<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function where(string $column, string $value)
    {
        return $this->model->query()->where($column, $value)->first();
    }

    public function create(array $data)
    {
        return $this->model->query()->create($data);
    }

    public function find($id)
    {
        return $this->model->query()->find($id);
    }

    public function with($relations): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model->with($relations);
    }
}
