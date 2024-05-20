<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HotelsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test list hotels successfully.
     */
    public function test_list_hotels_successfully()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $hotel = Hotel::factory()->country_id($country->id)->city_id($city->id)->create();

        $headers = [
            'Authorization' => $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->get('api/hotels', $headers);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'country',
                    'city',
                    'price',
                    'room_facilities',
                ],
            ],
        ]);
    }

    /**
     * test list hotels unauthorized.
     */
    public function test_list_hotels_unauthorized()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $hotel = Hotel::factory()->country_id($country->id)->city_id($city->id)->create();

        $headers = [
            'Accept' => 'application/json',
        ];

        $response = $this->get('api/hotels', $headers);

        $response->assertStatus(401);
    }

    /**
     * test list hotels unauthorized.
     */
    public function test_store_hotel_successfully()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $data = [
            'name' => 'test hotel',
            'country_code' => $country->code,
            'city' => $city->name,
            'price' => 100,
            'facilities' => [
                'fac1',
                'fac2',
            ],
        ];

        $headers = [
            'Authorization' => $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->post('api/hotels', $data, $headers);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'name',
                'country',
                'city',
                'price',
                'room_facilities',
            ],
        ]);
    }

    /**
     * test list hotels unauthorized.
     */
    public function test_store_hotel_with_validation_errors()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $data = [
        ];

        $headers = [
            'Authorization' => $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->post('api/hotels', $data, $headers);

        $response->assertStatus(422);
    }

    /**
     * test list hotels unauthorized.
     */
    public function test_store_hotel_unauthorized()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $data = [
            'name' => 'test hotel',
            'country_code' => $country->code,
            'city' => $city->name,
            'price' => 100,
            'facilities' => [
                'fac1',
                'fac2',
            ],
        ];

        $headers = [
            'Accept' => 'application/json',
        ];

        $response = $this->post('api/hotels', $data, $headers);

        $response->assertStatus(401);
    }

    /**
     * test list hotels successfully.
     */
    public function test_show_hotel_successfully()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $hotel = Hotel::factory()->country_id($country->id)->city_id($city->id)->create();

        $headers = [
            'Authorization' => $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->get('api/hotels/'.$hotel->id, $headers);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'name',
                'country',
                'city',
                'price',
                'room_facilities',
            ],
        ]);
    }

    /**
     * test list hotels successfully.
     */
    public function test_show_hotel_not_found()
    {
        $headers = [
            'Authorization' => $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->get('api/hotels/99999999', $headers);

        $response->assertStatus(404);
    }

    /**
     * test list hotels successfully.
     */
    public function test_update_hotel_successfully()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $hotel = Hotel::factory()->country_id($country->id)->city_id($city->id)->create();

        $data = [
            'name' => 'test hotel',
            'country_code' => $country->code,
            'city' => $city->name,
            'price' => 100,
            'facilities' => [
                'fac1',
                'fac2',
            ],
        ];

        $headers = [
            'Authorization' => $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->put('api/hotels/'.$hotel->id, $data, $headers);

        $response->assertStatus(200);
    }

    /**
     * test list hotels successfully.
     */
    public function test_update_hotel_unauthorized()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $hotel = Hotel::factory()->country_id($country->id)->city_id($city->id)->create();

        $data = [
            'name' => 'test hotel',
            'country_code' => $country->code,
            'city' => $city->name,
            'price' => 100,
            'facilities' => [
                'fac1',
                'fac2',
            ],
        ];

        $headers = [
            'Accept' => 'application/json',
        ];

        $response = $this->put('api/hotels/'.$hotel->id, $data, $headers);

        $response->assertStatus(401);
    }

    /**
     * test list hotels successfully.
     */
    public function test_update_hotel_not_found()
    {
        $country = Country::factory()->create();
        $city = City::factory()->name('city name')->country_id($country->id)->create();

        $hotel = Hotel::factory()->country_id($country->id)->city_id($city->id)->create();

        $data = [
            'name' => 'test hotel',
            'country_code' => $country->code,
            'city' => $city->name,
            'price' => 100,
            'facilities' => [
                'fac1',
                'fac2',
            ],
        ];

        $headers = [
            'Authorization' => $this->token,
            'Accept' => 'application/json',
        ];

        $response = $this->put('api/hotels/99999999', $data, $headers);

        $response->assertStatus(404);
    }
}
