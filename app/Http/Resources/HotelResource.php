<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country' => $this->country->name,
            'city' => $this->city->name,
            'price' => $this->price,
            'room_facilities' => RoomFacilityResource::collection($this->roomFacilities),
        ];
    }
}
