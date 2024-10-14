<?php

declare(strict_types=1);

namespace Src\Block\Infrastructure\Controller;

use Illuminate\Http\Request;
use Src\Block\Application\UseCase\RegisterBlock;
use Src\Block\Application\DTO\UserBlockRequest;
use App\Models\User as EloquentUser;
use Src\Shared\Domain\Model\User;
use Illuminate\Http\JsonResponse;

class BlockController
{

    public function __construct(
        // private GetBlocks $getBlocks,
        // private RegisterBlock $registerBlock,
        private RegisterBlock $registerBlockUseCase

    ) {}

    public function assignBlock(Request $request): JsonResponse
    {
        $eloquentUser = EloquentUser::find($request->input('user_id'));
        if (!$eloquentUser) {
            return new JsonResponse(['message' => 'User not found.'], 404);
        }

        $user = new User($eloquentUser->id, $eloquentUser->email);

        $userBlockRequest = new UserBlockRequest($request->input('user_id'), $request->input('block_id'));

        return $this->registerBlockUseCase->execute($userBlockRequest, $user);
    }



























    
    // public function index(): JsonResponse
    // {
    //     $blocks = $this->getBlocks->execute();
    //     return new JsonResponse($blocks, 200);
    // }

    // public function store(Request $request): JsonResponse
    // {
    //     $blockRequest = new UserBlockRequest(
    //         $request['block_id'],
    //         $request['user_id']
    //     );

    //     $this->registerBlock->execute($blockRequest);

    //     return response()->json(['message' => 'Block assigned successfully'], 201);
    // }

}