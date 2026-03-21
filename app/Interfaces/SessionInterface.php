<?php

namespace App\Interfaces;

use App\Models\Session;

interface SessionInterface
{
    public function index(array $busca, bool $nao_paginar = false);

    public function store(array $dados): array;

    public function update(Session $session, array $dados): array;

    public function destroy(Session $session): array;
}