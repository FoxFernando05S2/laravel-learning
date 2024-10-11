<?php 

declare(strict_types=1);

namespace Src\Profile\Domain\Model;

use Src\Shared\Domain\Model\User;

class Profile
{

    public function __construct(
        private int $id,
        private string $name,
        private string $apell,
        private string $document_number,
        private int $age,
        private string $address,
        private User $user_id
    ){
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getApell(){
        return $this->apell;
    }

    public function getAge(){
        return $this->age;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getUserId(){
        return $this->user_id;
    }
}