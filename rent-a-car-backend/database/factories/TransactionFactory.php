<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\RentalAgent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('2023-01-01', '2023-12-31'),
            'status' =>  $this->faker->randomElement($array = 
            array('Transaction successful.', 'Transaction pending.', 'Transaction unsuccessful.')),
            'user_id' => User::factory(),
            'rental_agent_id' => RentalAgent::factory(),
            'car_id' => Car::factory(),
        ];
    }
}
