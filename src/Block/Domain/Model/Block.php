<?php 

declare(strict_types=1);

namespace Src\Block\Domain\Model;

class Block
{

    public function __construct(
        private int $id,
        private int $capacity
    ){

    }

    public function getId(){
        return $this->id;
    }

    public function getCapacity(){
        return $this->capacity;
    }
}