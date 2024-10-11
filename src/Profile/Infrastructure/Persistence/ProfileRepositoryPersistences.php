<?php 

declare(strict_types=1);

namespace Src\Profile\Infrastructure\Persistence;

use App\Models\User as AppUser;
use App\Models\Profile as AppProfile;
use Src\Profile\Domain\Model\Profile;
use Src\Shared\Domain\Model\User;
use Src\Application\DTO\TypesResponse;
use Src\Profile\Domain\Repository\ProfileRepositoryInterface;
use Src\Shared\Domain\Exception\UserAlreadyHasProfileException;
use Src\Shared\Domain\Exception\UserNotFoundException;

class ProfileRepositoryPersistences implements ProfileRepositoryInterface
{
    public function getAll(): array
    {
        // $profiles = AppProfile::all();
        $profiles = AppProfile::with('user.types')->get();

        return $profiles->map(function($profile){
            return new Profile(
                $profile->id,
                $profile->name,
                $profile->lastname,
                $profile->document_number,
                $profile->age,
                $profile->address,
                new User(
                    $profile->user->id,
                    $profile->user->email,
                )
            );
        })->toArray();
    }

    public function register(string $name, string $lastname, string $document_number, int $age, string $address, int $userId): void
    {
        
        $user = AppUser::findOrFail($userId); 
        
        AppProfile::create([
            'name' => $name,
            'lastname' => $lastname,
            'document_number' => $document_number,
            'age' => $age,
            'address' => $address,
            'user_id' => $user->id 
        ]);
    }

    public function userExists(int $userId): bool
    {
        return AppUser::find($userId) !== null;
    }

    public function userHasProfile(int $userId): bool
    {
        return AppProfile::where('user_id', $userId)->exists();
    }

    public function validateUserProfile(int $userId): void
    {
        if (!$this->userExists($userId)) {
            throw new UserNotFoundException();
        }

        if ($this->userHasProfile($userId)) {
            throw new UserAlreadyHasProfileException();
        }
    }
}