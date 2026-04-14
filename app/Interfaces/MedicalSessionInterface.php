<?php

namespace App\Interfaces;

use App\Models\MedicalSession;

interface MedicalSessionInterface
{
    public function index(array $busca, bool $nao_paginar = false);

    public function store(array $dados): MedicalSession;

    public function update(MedicalSession $medical_session, array $dados): MedicalSession;

    public function destroy(MedicalSession $medical_session): bool;
}