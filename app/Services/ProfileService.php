<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ProfileService
{
    public function assignProfileToUser(int $profileId, int $userId): JsonResponse
    {
        // Buscar el perfil
        $profile = Profile::find($profileId);

        // Validar si el perfil ya está asignado a un usuario
        $currentUser = $profile->user()->first();
        if ($currentUser) {
            // Si el perfil ya está asignado a este usuario
            if ($currentUser->id === $userId) {
                return new JsonResponse(['message' => 'The profile is already assigned to this user.'], 400);
            }

            // Si el perfil está asignado a otro usuario, actualiza la relación
            $profile->user()->associate($userId);
            $profile->save();

            return new JsonResponse(['message' => 'Profile assignment successfully updated to the new user.']);
        }

        // Si el perfil no está asignado a ningún usuario, realiza la asignación
        $profile->user()->associate($userId);
        $profile->save();

        return new JsonResponse(['message' => 'Profile assigned successfully.']);
    }
}
