<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::factory()->times(5)->create();

        for ($i = 0; $i < 10; $i++) {
            Transaction::factory()->create([
                'date' => FakerFactory::create()->dateTimeBetween('2023-01-01', '2023-12-31'),
                'user_id' => 1, 
                'rental_agent_id' => 6, 
                'car_id' => $i + 1, 
            ]);
        }
    }
}
