<?php

namespace App\Interfaces;

use App\Models\Patient;

interface PatientInterface
{
    public function index();

    public function store(array $dados): array;

    public function update(Patient $patient, array $dados): array;

    public function destroy(Patient $patient): array;
}