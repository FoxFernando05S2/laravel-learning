<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
       /*  $userId = Auth::user();
        dd($userId); */
        // $profile = $request->route('profile');
        // if($profile->age<18){
        //     return new JsonResponse(['message'=>'El usuario es menor de edad']);
        // }
        
        $userId = Auth::user();
        dd($userId);
        
        $profile = $request->route('profile');

        if($profile->age<18){
            return new JsonResponse(['message'=>'El usuario es menor de edad']);
        }
        
        return $next($request);
    }
}
