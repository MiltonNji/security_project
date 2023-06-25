<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            $livingRooms = $faker->numberBetween(1, 5);
            $bedrooms = $faker->numberBetween(1, 4);
            $bathrooms = $faker->numberBetween(1, 3);

            House::create([
                'living_rooms' => $livingRooms,
                'bedrooms' => $bedrooms,
                'bathrooms' => $bathrooms,
            ]);
        }
    }
}
