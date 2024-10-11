<?php

namespace App\Services;

use App\Models\User;
use App\Models\Block;
use Illuminate\Support\Facades\DB;
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










class UserService
{
    
    public function assignBlockToUser(User $user, int $blockId): JsonResponse
    {   
        $block = $this->findBlock($blockId);    

        if ($block instanceof JsonResponse) {
            return $block; 
        }
       
        $classroomCapacity = $this->validateClassroomCapacity($block);
        if ($classroomCapacity instanceof JsonResponse) {
            return $classroomCapacity; 
        }
         
        $currentBlock = $user->blocks()->first();
        if ($currentBlock) {        
            if ($currentBlock->id === $blockId) {
                return new JsonResponse(['message' => 'The user is already assigned to this block.'], 400);
            }
            $user->blocks()->sync([$blockId]);
            return new JsonResponse(['message' => 'Block allocation successfully renewed']);
        }
        $user->blocks()->attach($blockId);
        return new JsonResponse(['message' => 'Block assigned successfully']);
    }

    private function findBlock(int $blockId)
    {
        $block = Block::find($blockId);
        if (!$block) {
            return new JsonResponse(['message' => 'Block not found.'], 404);
        }
        return $block;
    }

    private function validateClassroomCapacity(Block $block): ?JsonResponse
    {
        $classrooms = $block->classrooms;
       
        foreach ($classrooms as $classroom) {   
            $capacity = $classroom->capacity;
            $assignedUsersCount = User::whereHas('blocks', function ($query) use ($block, $classroom) {
                $query->where('block_id', $block->id)
                      ->whereHas('classrooms', function ($subQuery) use ($classroom) {
                          $subQuery->where('classroom_id', $classroom->id);
                      });
            })->count();
     
            if ($assignedUsersCount >= $capacity) {
                return new JsonResponse(['message' => 'Classroom capacity exceeded.'], 400);
            }
        }
        return null; 
    }
}
