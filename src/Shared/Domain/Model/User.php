<?php 

declare(strict_types=1);

namespace Src\Shared\Domain\Model;

class User
{

    public function __construct(
        private int $id,
        private string $email,
    ){
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }


}