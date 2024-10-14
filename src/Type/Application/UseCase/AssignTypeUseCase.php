<?php

declare(strict_types=1);

namespace Src\Type\Application\UseCase;

use Src\Type\Domain\Repository\TypeRepositoryInterface;
use Src\Type\Application\Service\TypeAssignmentService;
use Src\Shared\Domain\Model\User;
use Src\Type\Application\DTO\UserTypeRequest;
use Illuminate\Http\JsonResponse;

class AssignTypeUseCase
{
    public function __construct(private TypeAssignmentService $typeAssignmentService)
    {
        $this->typeAssignmentService = $typeAssignmentService;
    }

    public function execute(UserTypeRequest $request, User $user): JsonResponse
    {
        // Validamos que el tipo y usuario existan y que el usuario no tenga este tipo
        $type = $this->typeAssignmentService->validateUserAndType($user, $request->getTypeId());

        // Validamos las reglas específicas de asignación
        $this->typeAssignmentService->validateTypeAssignment($user, $type);

        // Asignamos el tipo al usuario
        $this->typeAssignmentService->assignTypeToUser($user, $type);

        return new JsonResponse(['message' => 'User successfully assigned to type.'], 200);
    }
}