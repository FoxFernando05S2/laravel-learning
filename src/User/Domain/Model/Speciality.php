<?php 

declare(strict_types=1);

namespace Src\User\Domain\Model;

class Speciality
{

    public function __construct(
        private int $id,
        private string $name,
        private string $description
    ){}

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }
}