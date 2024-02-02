<?php

namespace Database\Factories;

use App\Models\CarType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $abbreviationsForCities = array('RA', 'RU', 'SA', 'SV', 'SD', 
                                'SJ', 'SM', 'SO', 'SP', 'ST', 'SU', 'TO', 
                                'TS', 'TT', 'ĆU', 'UB', 'UE', 'UR', 'ČA', 
                                'ŠA', 'ŠI', 'NI', 'NP', 'NS', 'PA', 'PB', 
                                'PE', 'PŽ', 'PZ', 'PI', 'PK', 'PN', 'PO', 
                                'PP', 'PR', 'PT', 'VB', 'VL', 'VP', 'VR', 
                                'VS', 'VŠ', 'GL', 'GM', 'DE', 'ĐA', 'ZA', 
                                'ZR', 'IN', 'IC', 'JA', 'KA', 'KV', 'KG', 
                                'KŽ', 'KI', 'KL', 'KM', 'KO', 'KC', 'KŠ', 
                                'LB', 'LE', 'LO', 'LU', 'NV', 'NG', 'AL', 
                                'AR', 'AC', 'BB', 'BG', 'BO', 'BP', 'BT', 
                                'BĆ', 'BU', 'BČ', 'VA');
        $cityAbbreviation = $this->faker->randomElement($abbreviationsForCities);

        $car = (new \Faker\Factory())::create();
        $car->addProvider(new \Faker\Provider\Fakecar($car));
        $carName = $car->vehicle;
                return [
                    'name' => $carName,
                    'description' => $carName . ' is the ' . $this->faker->word(),
                    'image' => $this->faker->imageUrl(),
                    'price' => $this->faker->numberBetween($min = 50, $max = 500),
                    'rentTimeInDays' => $this->faker->numberBetween($min = 1, $max = 30),
                    'VIN' => $car->vin,
                    'fuelType' => $car->vehicleFuelType,
                    'gearType' => $car->vehicleGearBoxType,
                    'properties' => implode(', ', $car->vehicleProperties),
                    'registration' => $car->vehicleRegistration($cityAbbreviation . '-[0-9]{4}-[A-Z]{2}'),
                    'car_type_id' => CarType::factory(),
                ];
    }
}
