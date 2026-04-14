<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->numerify('###########'),
            'email' => $this->faker->optional()->safeEmail(),
            'birth_date' => $this->faker->optional()->date(),

            // ⚠️ IMPORTANTE: usa o setter (cpf virtual)
            'cpf' => $this->generateCpf(),

            'notes' => $this->faker->optional()->sentence(),
        ];
    }

    private function generateCpf(): string
    {
        // gera CPF fake simples (não validado, mas suficiente pra seed)
        return $this->faker->numerify('###########');
    }
}