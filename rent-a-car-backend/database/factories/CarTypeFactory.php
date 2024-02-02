<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarType>
 */
class CarTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $car = (new \Faker\Factory())::create();
        $car->addProvider(new \Faker\Provider\Fakecar($car));
        $carTypeName = $car->vehicleType;

        return [
            'name' => $carTypeName,
            'description' => 'Car type ' . $carTypeName . ' is defined as ' . $this->faker->word(),
        ];
    }
}
