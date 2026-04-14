<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\User;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            Patient::factory()
                ->count(10)
                ->create([
                    'user_id' => $user->id,
                ]);
        });
    }
}