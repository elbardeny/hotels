<?php

namespace App\Repositories;

interface RepositoryContract
{
    public function where(string $column, string $value);

    public function create(array $data);

    public function find(int $id);

    public function with(array $relations);
}
