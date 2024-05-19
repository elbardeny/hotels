<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities_data = [
            'EG' => [
                [
                    'name' => 'cairo'
                ], [
                    'name' => 'tanta'
                ],
            ],
            'SA' => [
                [
                    'name' => 'riyadh'
                ], [
                    'name' => 'madinah'
                ],
            ],
            'UAE' => [
                [
                    'name' => 'dubai'
                ], [
                    'name' => 'abo dhabi'
                ],
            ],
        ];

        $data = [];

        foreach ($cities_data as $country_code => $cities) {
            $country = Country::where('code', $country_code)->first();

            if ($country) {
                foreach ($cities as $city) {
                    $data[] = [
                        'name' => $city['name'],
                        'country_id' => $country->id
                    ];
                }
            }
        }

        if (count($data)) {
            DB::table('cities')->insert($data);
        }
    }
}
