<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

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

    public function handle($request, Closure $next, ...$types)
    {
        $user = $request->user();

        if (!$user || !$user->types()->whereIn('name', $types)->exists()) 
        {
            return response()->json(['message' => 'Unauthorized'], 403);
            }

        return $next($request);
    }
}
