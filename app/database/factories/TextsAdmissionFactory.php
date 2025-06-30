<?php

namespace Database\Factories;

use App\Models\Admission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TextsAdmission>
 */
class TextsAdmissionFactory extends Factory
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
            'AdParousa' => $this->faker->text,
            'AdPoreia' => $this->faker->text,
            'AdNeuron' => $this->faker->text,
            'AdAtomiko' => $this->faker->text,
            'AdProjections' => $this->faker->text,
        ];
    }
}
