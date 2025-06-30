<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Code' => Str::random(10),
            'LastName' => $this->faker->lastName,
            'FirstName' => $this->faker->firstName,
            'Gender' => $this->faker->numberBetween(0, 1),
            'BirthYear' => $this->faker->year,
            'FatherName' => $this->faker->firstName,
            'NationalityID' => $this->faker->numberBetween(1, 20),
            'InsuranceID' => $this->faker->numberBetween(1, 5),
            'Address' => $this->faker->address,
            'FirstPhone' => $this->faker->phoneNumber,
            'AM' => Str::random(10),
        ];
    }
}
