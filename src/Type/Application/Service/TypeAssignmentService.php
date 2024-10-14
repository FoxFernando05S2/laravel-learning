<?php

declare(strict_types=1);

namespace Src\Type\Application\Service;

use Src\Shared\Domain\Model\User;
use Src\Type\Domain\Model\Type;
use Src\Type\Domain\Repository\TypeRepositoryInterface;
use Src\Type\Domain\Exception\UserNotFoundException;
use Src\Type\Domain\Exception\TypeNotFoundException;
use Src\Type\Domain\Exception\UserAlreadyAssignedTypeException;
use Src\Type\Domain\Exception\UserCannotBeAssignedMoreThanOneTypeException;
use Src\Type\Domain\Exception\InvalidUserTypeAssignmentException;

class TypeAssignmentService
{
    private TypeRepositoryInterface $typeRepository;

    public function __construct(TypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function validateUserAndType(User $user, int $typeId): Type
    {
        // Verificar que el tipo exista
        $type = $this->typeRepository->findTypeById($typeId);
        if (!$type) {
            throw new TypeNotFoundException();
        }

        // Verificar si el usuario ya tiene este tipo
        if ($this->typeRepository->isUserAssignedToType($user, $type)) {
            throw new UserAlreadyAssignedTypeException();
        }

        return $type;
    }

    public function validateTypeAssignment(User $user, Type $type): void
    {
        $assignedTypes = $this->typeRepository->getUserAssignedTypes($user);

        if ($type->getName() === 'alumno') {
            // Si el usuario ya tiene otro tipo y es alumno, no puede asignarse otro
            if (!empty($assignedTypes)) {
                throw new UserCannotBeAssignedMoreThanOneTypeException();
            }
        } elseif (in_array($type->getName(), ['profesor', 'administrador'])) {
            // Profesor o administrador puede tener ambos roles, pero no junto con alumno
            foreach ($assignedTypes as $assignedType) {
                if ($assignedType->getName() === 'alumno') {
                    throw new InvalidUserTypeAssignmentException();
                }
            }
        }
    }

    public function assignTypeToUser(User $user, Type $type): void
    {
        $this->typeRepository->assignUserToType($user, $type);
    }
}