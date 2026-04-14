<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalSession;
use App\Models\Patient;
use App\Models\User;

class MedicalSessionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $patients = Patient::all();

        foreach ($patients as $patient) {
            MedicalSession::factory()->count(5)->create([
                'user_id' => $user->id,
                'patient_id' => $patient->id,
            ]);
        }
    }
}
