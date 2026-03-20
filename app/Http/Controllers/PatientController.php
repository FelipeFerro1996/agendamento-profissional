<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatienInsertRequest;
use App\Interfaces\PatientInterface;
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
