<?php

namespace App\Interfaces;

interface PatientInterface
{
    public function index();

    public function store(array $dados): array;
}