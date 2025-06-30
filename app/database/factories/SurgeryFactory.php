<?php

namespace Database\Factories;

use App\Models\Admission;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surgery>
 */
class SurgeryFactory extends Factory
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
            'DatePerformed' => $this->faker->dateTime(),
            'OperationID' => $this->faker->numberBetween(1, 10),
            'DoctorOperator' => Doctor::factory(),
            'DoctorAssistant' => Doctor::factory(),
            'DoctorAssistantB' => Doctor::factory(),
            'DoctorAnest' => Doctor::factory(),
            'AccessID' => $this->faker->numberBetween(1, 10),
            'AnesthisiaID' => $this->faker->numberBetween(1, 10),
            'IstologikaID' => $this->faker->numberBetween(1, 10),
            'AnestName' => $this->faker->name,
            'Notes' => $this->faker->text,
        ];
    }
}
