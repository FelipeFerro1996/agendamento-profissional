<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Patient;
use App\Models\User;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $patients = Patient::all();

        foreach ($patients as $patient) {
            Payment::create([
                'user_id' => $user->id,
                'patient_id' => $patient->id,
                'reference_month' => now()->format('Y-m'),
                'total_amount' => rand(300, 1000),
                'paid_amount' => rand(0, 1000),
                'due_date' => now()->addDays(10),
                'status' => 'open',
            ]);
        }
    }
}
