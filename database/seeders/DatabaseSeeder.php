<?php

namespace Database\Seeders;

use Database\Seeders\PatientSeeder as SeedersPatientSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SeedersPatientSeeder::class,
            MedicalSessionSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
