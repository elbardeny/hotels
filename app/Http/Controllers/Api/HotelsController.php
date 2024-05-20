<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\HotelsListRequest;
use App\Http\Requests\HotelsStoreRequest;
use App\Http\Resources\HotelResource;
use App\Services\HotelService;
use Illuminate\Http\JsonResponse;

class HotelsController
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index(HotelsListRequest $request): JsonResponse
    {
        $filters = $request->only('name', 'country', 'city', 'price');

        $hotels = $this->hotelService->list($filters, $request->sort_column ?? 'name', $request->sort_direction ?? 'asc');

        return response()->json([
            'status' => true,
            'data' => HotelResource::collection($hotels),
        ]);
    }

    public function store(HotelsStoreRequest $request): JsonResponse
    {
        $hotel = $this->hotelService->create($request->validated());

        return response()->json([
            'status' => true,
            'data' => HotelResource::make($hotel),
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $hotel = $this->hotelService->find($id);

        if (! $hotel) {
            return response()->json([
                'status' => false,
                'error' => 'hotel not found.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => true,
            'error' => null,
            'data' => HotelResource::make($hotel),
        ]);
    }

    public function update(HotelsStoreRequest $request, int $id): JsonResponse
    {
        $hotel = $this->hotelService->find($id);

        if (! $hotel) {
            return response()->json([
                'status' => false,
                'message' => 'hotel not found.',
            ], 404);
        }

        $this->hotelService->update($hotel, $request->validated());

        return response()->json([
            'status' => true,
            'message' => 'hotel updated successfully',
        ]);
    }

    public function delete(int $id): JsonResponse
    {
        $hotel = $this->hotelService->find($id);

        if (! $hotel) {
            return response()->json([
                'status' => false,
                'message' => 'hotel not found.',
            ], 404);
        }

        $this->hotelService->delete($hotel);

        return response()->json([
            'status' => true,
            'message' => 'hotel deleted successfully.',
        ]);
    }
}
