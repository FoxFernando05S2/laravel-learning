<?php 

declare(strict_types=1);

namespace Src\Block\Infrastructure\Persistence;

use App\Models\Block as AppBlock;
use App\Models\User as AppUser;
use Src\Shared\Domain\Exception\BlockCapacityExceededException;
use Src\Shared\Domain\Exception\UserNotFoundException;
use Src\Shared\Domain\Exception\BlockNotFoundException;
use Src\Shared\Domain\Exception\UserAlreadyAssignedToBlockException;


use App\Models\User as EloquentUser;
use App\Models\Block as EloquentBlock;
use Src\Shared\Domain\Model\User;
use Src\Block\Domain\Model\Block;
use Src\Block\Domain\Repository\BlockRepositoryInterface;

class BlockRepositoryPersistence implements BlockRepositoryInterface
{

    // public function getAll(): array
    // {
    //     $blocks = AppBlock::all();

    //     return $blocks->map(function($block) {
    //         return new Block(
    //             $block->id,
    //             $block->capacity
    //         );
    //     })->toArray();
    // }

    // public function register(string $name, int $capacity): void
    // {
    //     AppBlock::create([
    //         'name' => $name,
    //         'capacity' => $capacity,
    //     ]);
    // }


    public function findBlockById(int $blockId): ?Block
    {
        $block = EloquentBlock::find($blockId);
        if (!$block) {
            return null;
        }

        return new Block($block->id, $block->capacity);
    }
    public function assignUserToBlock(User $user, Block $block): void
    {
        $eloquentBlock = EloquentBlock::find($block->getId());
        $eloquentBlock->users()->attach($user->getId());
    }

    public function isUserAssignedToBlock(User $user, Block $block): bool
    {
        $eloquentBlock = EloquentBlock::find($block->getId());
        return $eloquentBlock->users()->where('user_id', $user->getId())->exists();
    }

    public function checkBlockCapacity(Block $block): bool
    {
        $eloquentBlock = EloquentBlock::find($block->getId());
        return $eloquentBlock->users()->count() < $eloquentBlock->capacity;
    }
}