<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalSessionInsertRequest;
use App\Http\Requests\MedicalSessionUpdateRequest;
use App\Http\Requests\SessionInsertRequest;
use App\Interfaces\MedicalSessionInterface;
use App\Models\MedicalSession;
use App\Models\Session;
use Illuminate\Http\Request;

class MedicalSessionController extends Controller
{

    public function __construct(
        protected MedicalSessionInterface $medical_session_repository
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $medical_sessions = $this->medical_session_repository->index($request->all());

        return response()->json($medical_sessions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicalSessionInsertRequest $request)
    {
        $response = $this->medical_session_repository->store($request->validated());

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalSession $medical_session)
    {
        return response()->json($medical_session);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicalSessionUpdateRequest $request, MedicalSession $medical_session)
    {
        $response = $this->medical_session_repository->update($medical_session, $request->validated());

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalSession $medical_session)
    {
        $response = $this->medical_session_repository->destroy($medical_session);
        
        return response()->json($response);
    }
}
