<?php 

namespace App\Repositories;

use App\Interfaces\PaymentInterface;
use App\Models\Payment;

class PaymentRepository implements PaymentInterface
{

    public function index(){
        return Payment::paginate(10);
    }

    public function store(array $dados): Payment
    {
        return Payment::create($dados);
    }

    public function update(Payment $payment, array $dados): Payment
    {
        $payment->update($dados);
        
        return $payment;
    }

    public function destroy(Payment $payment): bool
    {
        return $payment->delete();
    }

}