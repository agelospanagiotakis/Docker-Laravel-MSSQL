<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admission>
 */
class AdmissionFactory extends Factory
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
            'PatientID' => Patient::factory(),
            'FromDate' => $this->faker->dateTime(),
            'ToDate' => $this->faker->dateTime(),
            'DoctorA' => Doctor::factory(),
            'DoctorB' => Doctor::factory(),
            'Cause' => $this->faker->sentence,
        ];
    }
}
