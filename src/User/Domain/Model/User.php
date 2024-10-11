<?php 

declare(strict_types=1);

namespace Src\User\Domain\Model;

class User
{

    public function __construct(
        private int $id,
        private string $email,
        private string $password,
        private array $types = [],
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
    public function getPassword()
    {
        return $this->password;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

}