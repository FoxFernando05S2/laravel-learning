<?php

declare(strict_types=1);

namespace Src\Type\Infrastructure\Controller;

use Illuminate\Http\Request;
use Src\Type\Application\UseCase\AssignTypeUseCase;
use Src\Type\Application\DTO\UserTypeRequest;
use App\Models\User as EloquentUser;
use Src\Shared\Domain\Model\User;
use Illuminate\Http\JsonResponse;
use Src\Shared\Domain\Exception\UserNotFoundException;

class TypeController
{
    public function __construct(private AssignTypeUseCase $assignTypeUseCase)
    {
        $this->assignTypeUseCase = $assignTypeUseCase;
    }

    public function assignType(Request $request): JsonResponse
    {
        $eloquentUser = EloquentUser::find($request->input('user_id'));
        if (!$eloquentUser) {
            throw new UserNotFoundException();
        }

        // Mapeamos el modelo Eloquent a la entidad de dominio
        $user = new User($eloquentUser->id, $eloquentUser->email);

        // Creamos el request con los datos
        $userTypeRequest = new UserTypeRequest($request->input('user_id'), $request->input('type_id'));

        // Llamamos al caso de uso para la asignación
        return $this->assignTypeUseCase->execute($userTypeRequest, $user);
    }
}