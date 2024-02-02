<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::factory()->times(5)->create();

        Car::create([
            'name'=>"Yugo Red",
            'description' => "Old timer from the Republic of Yugoslavia.",
            'image' => "https://hips.hearstapps.com/hmg-prod/images/yugo-gv-placement-1528210669.jpg",
            'price'=>"30",
            'rentTimeInDays' => "25",
            'VIN' => "skccoekok2244kos",
            'fuelType' => "diesel",
            'gearType' => "manual",
            'properties' => "Big",
            'registration' => "BG-2748-YF",
            'car_type_id' => 1,
        ]);

        Car::create([
            'name'=>"Yugo Blue",
            'description' => "Old timer from the Republic of Yugoslavia.",
            'image' => "https://upload.wikimedia.org/wikipedia/commons/4/4d/1988_Yugo_GV_in_Blue%2C_front_left.jpg",
            'price'=>"30",
            'rentTimeInDays' => "25",
            'VIN' => "skccoekok2244kos",
            'fuelType' => "diesel",
            'gearType' => "manual",
            'properties' => "Big",
            'registration' => "BG-2748-YF",
            'car_type_id' => 1,
        ]);

        Car::create([
            'name'=>"Yugo White",
            'description' => "Old timer from the Republic of Yugoslavia.",
            'image' => "https://www.auto-data.net/images/f84/Zastava-Yugo-Koral.jpg",
            'price'=>"30",
            'rentTimeInDays' => "25",
            'VIN' => "skccoekok2244kos",
            'fuelType' => "diesel",
            'gearType' => "manual",
            'properties' => "Big",
            'registration' => "BG-2748-YF",
            'car_type_id' => 1,
        ]);
    }
}
