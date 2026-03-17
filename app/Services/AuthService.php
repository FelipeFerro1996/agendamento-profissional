<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function login($email, $password){

        $auth = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);

        if(!$auth){
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('api')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];

    }

    public function logout($user){
        $user->tokens()->delete();

        return [
            'message'=> 'Logout realizado'
        ];
    }

}