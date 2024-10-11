<?php 

declare(strict_types=1);

namespace   Src\Profile\Application\UseCase;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Src\Profile\Application\DTO\ProfileRequest;
use Src\Profile\Domain\Repository\ProfileRepositoryInterface;
use Src\Shared\Domain\Exception\UserAlreadyHasProfileException;
use Src\Shared\Domain\Exception\UserNotFoundException;

class RegisterProfile
{
    public function __construct(
        private ProfileRepositoryInterface $profileRepository,
    ) {}

    // public function execute(ProfileRequest $request): void
    // {
    //     // Registrar el perfil a través del repositorio
    //     $this->profileRepository->register(
    //         $request->name,
    //         $request->apell,
    //         $request->age,
    //         $request->address,
    //         $request->userId
    //     );
    // }
    
    public function execute(ProfileRequest $request): void {

        $this->profileRepository->validateUserProfile($request->userId);

        $this->profileRepository->register(
            $request->name, 
            $request->lastname, 
            $request->document_number, 
            $request->age, 
            $request->address, 
            $request->userId);
    }











































    // public function execute(string $name, string $lastname, string $document_number, int $age, string $address, int $userId): JsonResponse
    // {
    //     // Verificar si el usuario ya tiene un perfil
    //     $existingProfile = Profile::where('user_id', $userId)->first();

    //     if ($existingProfile) {
    //         // Si el usuario ya tiene un perfil, lanzar excepción o devolver un error
    //         throw new UserAlreadyHasProfileException('User already has a profile.');
    //     }

    //     // Iniciar la transacción para crear el perfil
    //     DB::transaction(function () use ($name, $lastname, $document_number, $age, $address, $userId) {
    //         $profile = new Profile();
    //         $profile->name = $name;
    //         $profile->lastname = $lastname;
    //         $profile->document_number = $document_number;
    //         $profile->age = $age;
    //         $profile->address = $address;
    //         $profile->user_id = $userId;
    //         $profile->save();
    //     });

    //     return new JsonResponse(['message' => 'Profile registered successfully.']);
    // }

}