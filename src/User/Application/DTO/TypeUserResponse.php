<?php 

declare(strict_types=1);

namespace Src\User\Application\DTO;

class TypeUserResponse
{
    public function __construct(
        // public int $id,
        public string $email,
        // public string $password,
        public array $types = [],
    )
    {
        
    }

}