<?php

namespace Database\Seeders;

use App\Models\RentalAgent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RentalAgent::create([
            'name'=>"Milos Novakovic",
            'city' => "Beograd",
            'address' => "Stankova 11",
            'email'=>"novak123@gmail.com",
            'telephone' => "06812345678",
        ]);

        RentalAgent::factory()->times(5)->create();
    }
}
