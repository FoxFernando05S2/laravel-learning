<?php 

declare(strict_types=1);

namespace Src\Block\Application\UseCase;


use App\Models\Block;
use Src\Shared\Domain\Model\User;
use Illuminate\Http\JsonResponse;
use Src\Block\Domain\Repository\BlockRepositoryInterface;
use Src\Block\Application\DTO\UserBlockRequest;



class RegisterBlock
{
    public function __construct(
        private BlockRepositoryInterface $blockRepository
    ) {}

    public function execute(UserBlockRequest $request, User $user): JsonResponse
    {
        $block = $this->blockRepository->findBlockById($request->getBlockId());

        if (!$block) {
            return new JsonResponse(['message' => 'Block not found.'], 404);
        }

        // Verificar si el bloque tiene capacidad
        if (!$this->blockRepository->checkBlockCapacity($block)) {
            return new JsonResponse(['message' => 'Block capacity exceeded.'], 400);
        }

        // Verificar si el usuario ya está asignado al bloque
        if ($this->blockRepository->isUserAssignedToBlock($user, $block)) {
            return new JsonResponse(['message' => 'User is already assigned to this block.'], 400);
        }

        // Asignar el usuario al bloque
        $this->blockRepository->assignUserToBlock($user, $block);

        return new JsonResponse(['message' => 'User successfully assigned to block.'], 200);
    }

}