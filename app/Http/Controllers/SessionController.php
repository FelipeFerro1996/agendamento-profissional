<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionInsertRequest;
use App\Interfaces\SessionInterface;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function __construct(
        protected SessionInterface $session_repository
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sessions = $this->session_repository->index($request->all());

        return response()->json($sessions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionInsertRequest $request)
    {
        $response = $this->session_repository->store($request->validated());

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        return response()->json($session);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        $response = $this->session_repository->update($request->validated(), $request->validated());

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $response = $this->session_repository->destroy($session);
        
        return response()->json($response);
    }
}
