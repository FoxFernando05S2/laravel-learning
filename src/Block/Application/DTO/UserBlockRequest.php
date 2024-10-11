<?php

declare(strict_types=1);

namespace Src\Block\Application\DTO;

class UserBlockRequest
{
    public function __construct(
        public int $blockId,
        public int $userId
    ) {}

    public function getBlockId() : int
    {
        return $this->blockId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}