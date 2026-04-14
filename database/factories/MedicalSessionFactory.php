<?php

namespace Database\Factories;

use App\Models\MedicalSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MedicalSession>
 */
class MedicalSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'session_date' => $this->faker->date(),
            'session_time' => $this->faker->time(),
            'price' => $this->faker->randomFloat(2, 100, 500),
            'status' => $this->faker->randomElement(['scheduled','done','cancelled']),
            'paid' => $this->faker->boolean(),
            'paid_at' => now(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
