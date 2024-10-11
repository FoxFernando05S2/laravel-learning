<?php 

declare(strict_types=1);

namespace   Src\Profile\Application\UseCase;

use Src\Shared\Application\DTO\UserResponse;
use Src\Profile\Application\DTO\ProfileResponse;
use Src\Profile\Domain\Repository\ProfileRepositoryInterface;
class GetProfiles
{
    public function __construct(
        private ProfileRepositoryInterface $profileRepositoryInterface,
    ){
    }

    public function execute(): array
    {
        $users = $this->profileRepositoryInterface->getAll();

        return array_map(function($profile){
            return new ProfileResponse(
                name: $profile->getName(),
                apell: $profile->getApell(),
                age: $profile->getAge(),
                address: $profile->getAddress(),
                user: new UserResponse(
                    email:$profile->getUserId()->getEmail(),
                )

            );
        }, $users);
    }
}
