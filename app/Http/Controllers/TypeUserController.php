<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Type;
use Illuminate\Http\JsonResponse;

class TypeUserController extends Controller
{
    // Asignar un tipo a un usuario
    public function assignTypeToUser(Request $request, User $user): JsonResponse
    {
        $typeIds = $request->input('type_ids'); // Lista de IDs de tipos a asignar
        $user->types()->sync($typeIds); // Puedes usar sync, attach, o detach según la operación
        return new JsonResponse(['message' => 'Tipos asignados al usuario con éxito.']);
    }

   
    public function getUserTypes(User $user): JsonResponse
    {
        $types = $user->types()->get(); 
        return new JsonResponse($types);
    }

    
    public function removeTypeFromUser(User $user, Type $type): JsonResponse
    {
        $user->types()->detach($type->id); 
        return new JsonResponse(['message' => 'Tipo de usuario eliminado.']);
    }
}
