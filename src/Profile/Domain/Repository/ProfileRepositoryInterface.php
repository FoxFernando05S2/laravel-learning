<?php 

declare(strict_types=1);

namespace Src\Profile\Domain\Repository;

interface ProfileRepositoryInterface
{

    public function getAll(): array;
    // public function getById(int $id): ?User;
    public function register(string $name, string $lasname, string $document_number, int $age, string $address, int $userId): void;

    // public function update(int $id, string $email, string $password):void;

    // public function delete (int $id):void;
    public function userExists(int $userId): bool;
    public function userHasProfile(int $userId): bool;
    public function validateUserProfile(int $userId): void;
}