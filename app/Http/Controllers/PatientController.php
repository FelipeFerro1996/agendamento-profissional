<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatienInsertRequest;
use App\Interfaces\PatientInterface;
use App\Models\Patient;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    use ApiResponse;
    
    public function __construct(
        protected PatientInterface $patient_repository
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $patients = $this->patient_repository->index();

        return $this->success($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatienInsertRequest $request)
    {
        $response = $this->patient_repository->store($request->validated());

        return $this->success($response, 'Paciente incluído com sucesso', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return $this->success($patient, 'Paciente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatienInsertRequest $request, Patient $patient)
    {
        $update = $this->patient_repository->update($patient, $request->validated());

        return $this->success($update, 'Paciente incluído com sucesso', 201);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $this->patient_repository->destroy($patient);

        return $this->success(message:'Paciente excluído com sucesso');
    }
}
