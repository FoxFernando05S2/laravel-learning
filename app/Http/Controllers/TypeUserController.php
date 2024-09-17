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

    // Obtener tipos de usuario
    public function getUserTypes(User $user): JsonResponse
    {
        $types = $user->types()->get(); // Obtener tipos asignados a un usuario
        return new JsonResponse($types);
    }

    // Eliminar un tipo de usuario
    public function removeTypeFromUser(User $user, Type $type): JsonResponse
    {
        $user->types()->detach($type->id); // Eliminar la relación de un tipo específico
        return new JsonResponse(['message' => 'Tipo de usuario eliminado.']);
    }
}
