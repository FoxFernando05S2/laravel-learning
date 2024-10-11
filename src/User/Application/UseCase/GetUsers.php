<?php

declare(strict_types=1);

namespace Src\User\Application\UseCase;

use Src\User\Application\DTO\TypeUserResponse;
use Src\User\Domain\Repository\UserRepositoryInterface;

class GetUsers 
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
    ){
    }

    public function execute(): array
    {
        $users = $this->userRepository->getAll();

        return array_map(function($user) {
            return new TypeUserResponse(
                email: $user->getEmail(),
                types: $user->getTypes(), 
            );
        }, $users);

    }
}