<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'FirstName' => $this->faker->firstName,
            'LastName' => $this->faker->lastName,
            'Abbreviation' => Str::random(5),
            'PrintedProfession' => $this->faker->jobTitle,
            'SpecializationID' => $this->faker->numberBetween(1, 10),
            'Title' => $this->faker->jobTitle,
            'DisplayOrder' => $this->faker->numberBetween(1, 10),
            'Role' => $this->faker->numberBetween(1, 5),
            'IsActive' => $this->faker->boolean,
            'UserName' => $this->faker->userName,
        ];
    }
}
