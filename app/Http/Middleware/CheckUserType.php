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
    /**
     * Handle an incoming request.
     */
    // public function handle(Request $request, Closure $next, ...$types)
    // {
    //     // Obtener el usuario autenticado
    //     $user = Auth::user();

    //     // Validar si el usuario tiene uno de los tipos permitidos (alumno o profesor)
    //     if ($user && $user->types()->whereIn('name', $types)->exists()) {
    //         return $next($request);
    //     }

    //     // Si el usuario no es un alumno o profesor, redirigir o lanzar error
    //     return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);
    // }

    // public function handle(Request $request, Closure $next, $type)
    // {
    //     // Validar si el usuario tiene el tipo solicitado (alumno o profesor)
    //     if (!Auth::check() || !$request->user()->types->contains('name', $type)) {
    //         return response()->json(['error' => 'No tienes permiso para acceder a esta ruta.'], 403);
    //     }

    //     return $next($request);
    // }

    // public function handle(Request $request, Closure $next, ...$types)
    // {
    //     $user = Auth::user(); // Obtener el usuario autenticado

    //     // Verifica si el usuario tiene al menos uno de los tipos requeridos
    //     $userTypes = $user->types->pluck('name')->toArray(); // Asegúrate de que 'name' sea el campo adecuado

    //     foreach ($types as $type) {
    //         if (in_array($type, $userTypes)) {
    //             return $next($request);
    //         }
    //     }

    //     
    //     return response()->json(['message' => 'Unauthorized'], 403);
    // }

    

        // if (!$user->types()->where('name', $type)->exists()) {
        //     // return response()->json(['message' => "Unauthorized. User does not have the required type: $type"], 403);
        //     return new JsonResponse(['message' => "Unauthorized. User does not have the required type: $type"], 403);
        // }

        // $hasType = $user->types()->where('name', $type)->exists();

        // if (!$hasType) {
        //     return new JsonResponse(['message' => "Unauthorized. User does not have the required type: $type"], 403);
        // }

        // return $next($request);

    public function handle(Request $request, Closure $next, string $type)
    {
        
        $user = $request->user();
        
        if (!$user) {
            return new JsonResponse(['message' => 'Unauthenticated.'], 401);
        }
        // dd($type);

        $userType = $user->types()->pluck('name')->first(); 
        // dd($userType);

        // if (!$userType) {
        //     return new JsonResponse(['message' => 'User has no type assigned.'], 403);
        // }

        if ($userType !== $type) {
            return new JsonResponse(['message' => 'No tienes permiso para realizar esta acción.'], 403);
        }

        return $next($request);
    }
}