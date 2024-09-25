<?php

namespace App\Http\Controllers;


use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        
        if(!$user){
            return new JsonResponse(['message' => "The email{$request->email} is not found."], Response::HTTP_NOT_FOUND);
        }

        if(!Hash::check($request->password, $user->password)){
            throw new Exception('Invalid credentials', Response::HTTP_UNAUTHORIZED);
        }
        
        Auth::login($user);

        $key = 'example_key';
        $payload=[
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 500,
        ];
        
        $token = JWT::encode($payload, config('services.JWT.key'), 'HS256');
        return new JsonResponse(['message'=>'session started successfully', 'token' => $token]);
    }
}
