<?php

namespace App\Interfaces;

use App\Models\Patient;

interface PatientInterface
{
    public function index();

    public function store(array $dados): Patient;

    public function update(Patient $patient, array $dados): Patient;

    public function destroy(Patient $patient): bool;
}