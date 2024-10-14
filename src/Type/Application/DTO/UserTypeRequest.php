<?php

declare(strict_types=1);

namespace Src\Type\Application\DTO;

class UserTypeRequest
{

    public function __construct(
        private int $userId, 
        private int $typeId
        
    ){}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }
}