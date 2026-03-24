<?php

namespace App\Interfaces;

use App\Models\Payment;

interface PaymentInterface
{
    public function index();

    public function store(array $dados): Payment;

    public function update(Payment $payment, array $dados): Payment;

    public function destroy(Payment $payment): bool;
}