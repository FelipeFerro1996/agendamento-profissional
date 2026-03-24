<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentInsertRequest;
use App\Http\Requests\PaymentUpdateRequest;
use App\Interfaces\PaymentInterface;
use App\Models\Payment;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected PaymentInterface $payment_repository
    )
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->payment_repository->index();
        return $this->success($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentInsertRequest $request)
    {
        $response = $this->payment_repository->store($request->validated());

        return $this->success($response, 'Pagamento incluído com sucesso', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return $this->success($payment, 'Pagamento', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentUpdateRequest $request, Payment $payment)
    {
        $response = $this->payment_repository->update($payment, $request->validated());

        return $this->success($response, 'Pagamento alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $this->payment_repository->destroy($payment);

        return $this->success(message:'Pagamento excluído com sucesso');
    }
}
