<?php 

declare(strict_types=1);

namespace Src\Profile\Application\DTO;

use Src\Shared\Application\DTO\UserResponse;

class ProfileRequest
{

    public function __construct(
        public string $name,
        public string $lastname,
        public string $document_number,
        public int $age,
        public string $address,
        public int $userId
    )
    {
    }
}