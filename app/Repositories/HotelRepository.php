<?php

namespace App\Repositories;

use App\Models\Hotel;
use Illuminate\Support\Arr;

class HotelRepository extends Repository
{
    public function __construct(Hotel $model)
    {
        $this->model = $model;
    }

    public function all($filters, $sortColumn, $sortDirection)
    {
        $sortable_columns = [
            'name' => 'hotels.name',
            'country' => 'countries.name',
            'city' => 'cities.name',
            'price' => 'hotels.price',
        ];

        $query = $this->applyFilters($filters);

        return $query->with(['country', 'city'])
            ->orderBy(Arr::get($sortable_columns, $sortColumn, 'hotels.name'), $sortDirection ?? 'asc')
            ->paginate(20);
    }

    private function applyFilters($filters): \Illuminate\Database\Eloquent\Builder
    {
        $query = $this->model->query()->select('hotels.*');

        $query->join('countries', 'hotels.country_id', '=', 'countries.id');
        $query->join('cities', 'hotels.city_id', '=', 'cities.id');

        if (isset($filters['name']) and $filters['name'])
            $query->where('hotels.name', 'like', '%' . $filters['name'] . '%');

        if (isset($filters['price']) and $filters['price'])
            $query->where('hotels.price', $filters['price']);

        if (isset($filters['country']) && $filters['country']) {
            $query->where('countries.name', 'like', '%' . $filters['country'] . '%');
        }

        if (isset($filters['city']) && $filters['city']) {
            $query->where('cities.name', 'like', '%' . $filters['city'] . '%');
        }

        return $query;
    }

    public function deleteRoomFacilities(Hotel $hotel)
    {
        $hotel->roomFacilities()->delete();
    }

    public function update($hotel, $data)
    {
        $hotel->update($data);
    }

    public function delete($hotel)
    {
        $hotel->delete();
    }
}
