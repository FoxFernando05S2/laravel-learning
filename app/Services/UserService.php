<?php

namespace App\Services;

use App\Models\User;
use App\Models\Block;
use Illuminate\Http\JsonResponse;

// class UserService
// {
//     public function assignBlockToUser(User $user, int $blockId): JsonResponse
//     {
//         $currentBlock = $user->blocks()->first();

//         if ($currentBlock) {
//             if ($currentBlock->id === $blockId) {
//                 return new JsonResponse(['message' => 'The user is already assigned to this block.'], 400);
//             }
//             $user->blocks()->sync([$blockId]);
//             return new JsonResponse(['message' => 'Block allocation successfully renewed']);
//         }

//         $user->blocks()->attach($blockId);
//         return new JsonResponse(['message' => 'Block assigned successfully']);
//     }


















// class UserService
// {
//     // Validación y asignación de bloque
//     public function assignBlockToUser(User $user, int $blockId): JsonResponse
//     {
//         // Validar si el bloque existe
//         $block = $this->findBlock($blockId);
//         if ($block instanceof JsonResponse) {
//             return $block;
//         }

//         // Validar si el bloque tiene capacidad disponible en su clase
//         $classroomCapacity = $this->validateClassroomCapacity($block);
//         if ($classroomCapacity instanceof JsonResponse) {
//             return $classroomCapacity;
//         }

//         // Validar si el usuario ya está asignado a un bloque
//         $currentBlock = $user->blocks()->first();
//         if ($currentBlock) {
//             // Si ya está asignado al mismo bloque, devolver error
//             if ($currentBlock->id === $blockId) {
//                 return new JsonResponse(['message' => 'The user is already assigned to this block.'], 400);
//             }

//             // Si está asignado a otro bloque, renovar la asignación
//             $user->blocks()->sync([$blockId]);
//             return new JsonResponse(['message' => 'Block allocation successfully renewed']);
//         }

//         // Si el usuario no está asignado a ningún bloque, proceder con la asignación
//         $user->blocks()->attach($blockId);
//         return new JsonResponse(['message' => 'Block assigned successfully']);
//     }

//     // Método para encontrar el bloque y devolver error si no existe
//     private function findBlock(int $blockId)
//     {
//         $block = Block::find($blockId);
//         if (!$block) {
//             return new JsonResponse(['message' => 'Block not found.'], 404);
//         }

//         return $block;
//     }

//     // Validar si el bloque pertenece a un salón que tiene capacidad disponible
//     private function validateClassroomCapacity(Block $block): ?JsonResponse
//     {
//         $classroom = $block->classroom;

//         // Obtener el número de usuarios asignados al salón
//         $assignedUsersCount = $classroom->users()->count();

//         // Validar si la capacidad del salón ya fue alcanzada
//         if ($assignedUsersCount >= $classroom->capacity) {
//             return new JsonResponse(['message' => 'Classroom capacity exceeded.'], 400);
//         }

//         return null;
//     }



class UserService
{
    // Validación y asignación de bloque
    public function assignBlockToUser(User $user, int $blockId): JsonResponse
    {
        // Validar si el bloque existe
        $block = $this->findBlock($blockId);
        

        if ($block instanceof JsonResponse) {
            return $block; // Devolver respuesta de error si no se encuentra el bloque
        }

        // Validar si el bloque tiene capacidad disponible en su clase
        $classroomCapacity = $this->validateClassroomCapacity($block);
        if ($classroomCapacity instanceof JsonResponse) {
            return $classroomCapacity; // Devolver respuesta de error si la capacidad está excedida
        }

        // Validar si el usuario ya está asignado a un bloque
        $currentBlock = $user->blocks()->first();
        if ($currentBlock) {
            // Si ya está asignado al mismo bloque, devolver error
            if ($currentBlock->id === $blockId) {
                return new JsonResponse(['message' => 'The user is already assigned to this block.'], 400);
            }

            // Si está asignado a otro bloque, renovar la asignación
            $user->blocks()->sync([$blockId]);
            return new JsonResponse(['message' => 'Block allocation successfully renewed']);
        }

        // Si el usuario no está asignado a ningún bloque, proceder con la asignación
        $user->blocks()->attach($blockId);
        return new JsonResponse(['message' => 'Block assigned successfully']);
    }

    // Método para encontrar el bloque y devolver error si no existe
    private function findBlock(int $blockId)
    {
        $block = Block::find($blockId);
        if (!$block) {
            return new JsonResponse(['message' => 'Block not found.'], 404);
        }

        return $block; // Devuelve el bloque encontrado
    }


    private function validateClassroomCapacity(Block $block): ?JsonResponse
    {
        $classroom = $block->classroom; // Asegúrate de que la relación `classroom` está bien definida

        // Obtener el número de usuarios asignados al salón
        $assignedUsersCount = $classroom->users()->count();

        // Validar si la capacidad del salón ya fue alcanzada
        if ($assignedUsersCount >= $classroom->capacity) {
            return new JsonResponse(['message' => 'Classroom capacity exceeded.'], 400);
        }
        
        return null; // No se devuelve error si la capacidad es suficiente
    }

    // private function validateClassroomCapacity(Block $block): ?JsonResponse
    // {
    //     $classrooms = $block->classrooms; // Obtener aulas asociadas
    
    //     if ($classrooms->isEmpty()) {
    //         return new JsonResponse(['message' => 'No classrooms associated with this block.'], 400);
    //     }
    
    //     // Suponiendo que solo estás usando el primer aula
    //     $classroom = $classrooms->first();
    
    //     // Obtener el número de usuarios asignados al salón
    //     $assignedUsersCount = $classroom->users()->count();
    
    //     // Validar si la capacidad del salón ya fue alcanzada
    //     if ($assignedUsersCount >= $classroom->capacity) {
    //         return new JsonResponse(['message' => 'Classroom capacity exceeded.'], 400);
    //     }
    
    //     return null; // No se devuelve error si la capacidad es suficiente
    // }
    
        

}
