<?php 

declare(strict_types=1);

namespace Src\Block\Domain\Repository;

use Src\Shared\Domain\Model\User;
use Src\Block\Domain\Model\Block;

interface BlockRepositoryInterface
{
    // public function getAll(): array;

    // // public function getById(int $id): ?User;

    public function findBlockById(int $blockId): ?Block;
    public function assignUserToBlock(User $user, Block $block): void;
    public function isUserAssignedToBlock(User $user, Block $block): bool;
    public function checkBlockCapacity(Block $block): bool;
}