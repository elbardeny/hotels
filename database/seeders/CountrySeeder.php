<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'egypt',
                'code' => 'EG'
            ], [
                'name' => 'saudi arabia',
                'code' => 'SA'
            ], [
                'name' => 'united arab emirates',
                'code' => 'UAE'
            ],
        ];

        DB::table('countries')->insert($data);
    }
}
