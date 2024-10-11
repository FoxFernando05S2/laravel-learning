<?php 

declare(strict_types=1);

namespace Src\User\Application\DTO;

class TypesResponse
{

    public function __construct(
        public string $cargo,
        public string $description,
    )
    {
    }

    

}