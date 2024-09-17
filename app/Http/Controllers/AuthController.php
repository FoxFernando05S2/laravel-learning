<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->where('password', $request->password)->first();
        Auth::login($user);

        $key = 'example_key';
        $payload=[
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 300,
        ];
        
        $token = JWT::encode($payload, config('services.JWT.key'), 'HS256');
        return new JsonResponse(['message'=>'session started successfully', 'token' => $token]);
    }
}
