<?php

declare(strict_types=1);

namespace Src\User\Infrastructure\Persistence;

use App\Models\User as AppUser;
use Src\User\Application\DTO\TypesResponse;
use Src\User\Domain\Model\User ;
use Src\Domain\Model\Type;
use Src\User\Domain\Repository\UserRepositoryInterface;

class UserRepositoryPersistence implements UserRepositoryInterface
{

    public function getAll(): array
    {
        $users = AppUser::with('types')->get();

        return $users->map(function($user) {
            return new User(
                $user->id,
                $user->email,
                $user->password,
                $user->types->map(function($type) {
                    return new TypesResponse($type->name,$type->description); 
                })->toArray()
                
                // $user->types->map(function($type) {
                //     return [
                //          'id' => $type->id,
                //         'cargo' => $type->name,
                //         'description' => $type->description,
                //     ];
                // })->toArray()
            );
        })->toArray();
    }
}