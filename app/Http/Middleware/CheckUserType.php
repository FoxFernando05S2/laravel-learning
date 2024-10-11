<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    public function handle(Request $request, Closure $next, string $type)
    {
        $user = $request->user();
        
        if (!$user) {
            return new JsonResponse(['message' => 'Unauthenticated.'], 401);
        }
        $userType = $user->types()->pluck('name')->first(); 
        
        if ($userType !== $type) {
            return new JsonResponse(['message' => 'No tienes permiso para realizar esta acción.'], 403);
        }
        return $next($request);
    }
}