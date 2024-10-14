<?php 

declare(strict_types=1);

namespace Src\Type\Infrastructure\Persistence;

use App\Models\User as EloquentUser;
use App\Models\Type as EloquentType;
use Src\Shared\Domain\Model\User;
use Src\Type\Domain\Model\Type;
use Src\Type\Domain\Repository\TypeRepositoryInterface;

class TypeRepositoryPersistence implements TypeRepositoryInterface
{
    public function findTypeById(int $typeId): ?Type
    {
        $type = EloquentType::find($typeId);
        if (!$type) {
            return null;
        }
        // Mapeo de Eloquent a Dominio
        return new Type($type->id, $type->name, $type->description);
    }

    public function assignUserToType(User $user, Type $type): void
    {
        $eloquentUser = EloquentUser::find($user->getId());
        $eloquentType = EloquentType::find($type->getId());

        $eloquentUser->types()->attach($eloquentType->id);
    }

    public function isUserAssignedToType(User $user, Type $type): bool
    {
        $eloquentUser = EloquentUser::find($user->getId());
        return $eloquentUser->types()->where('type_id', $type->getId())->exists();
    }

    public function getUserAssignedTypes(User $user): array
    {
        $eloquentUser = EloquentUser::find($user->getId());
        $types = $eloquentUser->types()->get();
        
        return $types->map(function ($type) {
            return new Type($type->id, $type->name, $type->description);
        })->toArray();
    }
}