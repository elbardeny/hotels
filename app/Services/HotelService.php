<?php

namespace App\Services;

use App\Models\RoomFacility;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\HotelRepository;

class HotelService
{
    private HotelRepository $hotelRepository;

    private CountryRepository $countryRepository;

    private CityRepository $cityRepository;

    public function __construct(HotelRepository $hotelRepository, CountryRepository $countryRepository, CityRepository $cityRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
    }

    public function list($filters, $sortColumn, $sortDirection)
    {
        return $this->hotelRepository->all($filters, $sortColumn, $sortDirection);
    }

    public function create($data)
    {
        $country = $this->countryRepository->where('code', $data['country_code']);
        $city = $this->cityRepository->where('name', $data['city']);

        $data['city_id'] = $city->id;
        $data['country_id'] = $country->id;

        $hotel = $this->hotelRepository->create($data);

        if (isset($data['room_facilities']) && count($data['room_facilities'])) {
            $this->addFacilities($hotel, $data['room_facilities']);
        }

        return $hotel;
    }

    public function find($id)
    {
        return $this->hotelRepository->with(['roomFacilities'])->find($id);
    }

    public function update($hotel, $data)
    {
        $this->hotelRepository->deleteRoomFacilities($hotel);

        $this->hotelRepository->update($hotel, $data);

        if (isset($data['room_facilities']) && count($data['room_facilities'])) {
            $this->addFacilities($hotel, $data['room_facilities']);
        }
    }

    public function delete($hotel)
    {
        $this->hotelRepository->deleteRoomFacilities($hotel);

        $this->hotelRepository->delete($hotel);
    }

    public function addFacilities($hotel, $room_facilities_data)
    {
        $room_facilities = [];

        foreach ($room_facilities_data as $room_facility) {
            $room_facilities[] = new RoomFacility(['name' => $room_facility]);
        }

        $hotel->roomFacilities()->saveMany($room_facilities);
    }
}
