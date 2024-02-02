<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalAgent>
 */
class RentalAgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'email' => $this->faker->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
        ];
    }
}
