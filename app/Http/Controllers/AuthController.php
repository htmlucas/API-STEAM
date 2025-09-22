<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // 403 = forbidden 
    // 401 = autorizaçãoo

    public function login(Request $request) 
    {
        $data = $request->only(['email', 'password', 'remember']);

        $validator = Validator::make($data, [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!empty($data['remember']) && $data['remember']) {
            auth('api')->setTTL(60 * 24 * 7); // minutos
        }

        if(!$token = auth('api')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])){
            return response()->json(['message' => 'Usuário ou senha inválidos'], 401);
        }
        
        $user = auth('api')->user();

        $user->makeHidden(['password', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes']);

        return response()->json([
            'user'       => $user,
            'token'      => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60, // em segundos
        ], 200);
    }

    public function logout(Request $request) 
    {
        auth('api')->logout();
        return response()->json(['message' => 'Logout realizado com sucesso!.']);
    }

    public function refresh(Request $request) 
    {
        return response()->json([
            'token'      => auth('api')->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
    
    public function me(Request $request) 
    {
        return response()->json(auth('api')->user());
    }
}
