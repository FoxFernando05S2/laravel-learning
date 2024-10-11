<?php 

declare(strict_types=1);

namespace Src\Profile\Application\DTO;

use Src\Shared\Application\DTO\UserResponse;

class ProfileResponse 
{

    public function __construct(
        public string $name,
        public string $apell,
        public int $age,
        public string $address,
        public UserResponse $user,
    )
    {
    }
}