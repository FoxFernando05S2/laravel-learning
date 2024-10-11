<?php 

declare(strict_types=1);

namespace Src\User\Domain\Repository;

interface UserRepositoryInterface
{
    public function getAll():array;

    // public function getById(int $id): ?User;

    // public function register(string $email, string $password): void;

    // public function update(int $id, string $email, string $password):void;

    // public function delete (int $id):void;


}