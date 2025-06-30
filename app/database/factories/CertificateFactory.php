<?php

namespace Database\Factories;

use App\Models\Admission;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certificate>
 */
class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'AdmissionID' => Admission::factory(),
            'DoctorA' => Doctor::factory(),
            'DoctorB' => Doctor::factory(),
            'FromDate' => $this->faker->dateTime(),
            'ToDate' => $this->faker->dateTime(),
            'IssuedDate' => $this->faker->dateTime(),
            'Notes' => $this->faker->text,
        ];
    }
}
