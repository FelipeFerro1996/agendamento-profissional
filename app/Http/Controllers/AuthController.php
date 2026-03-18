<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(
        protected AuthService $authService
    ) {
    }

    public function login(LoginRequest $request){
        return $this->authService->login(
            email:$request->email,
            password:$request->password
        );
    }

    public function me(Request $request){
        return response()->json($request->user());
    }

    public function logout(Request $request){
        return $this->authService->logout($request->user());
    }
    
}