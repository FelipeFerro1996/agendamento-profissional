<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatienInsertRequest;
use App\Interfaces\PatientInterface;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    
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

        return response()->json($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatienInsertRequest $request)
    {
        $response = $this->patient_repository->store($request->validated());

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return response()->json($patient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatienInsertRequest $request, Patient $patient)
    {
        $update = $this->patient_repository->update($patient, $request->validated());

        return response()->json($update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $delete = $this->patient_repository->destroy($patient);

        return response()->json($delete);
    }
}
