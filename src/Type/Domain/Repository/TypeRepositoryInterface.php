<?php

declare(strict_types=1);

namespace Src\Type\Domain\Repository;

use Src\Shared\Domain\Model\User;
use Src\Type\Domain\Model\Type;

interface TypeRepositoryInterface
{
    public function findTypeById(int $typeId): ?Type;
    public function assignUserToType(User $user, Type $type): void;
    public function isUserAssignedToType(User $user, Type $type): bool;
    public function getUserAssignedTypes(User $user): array;
}