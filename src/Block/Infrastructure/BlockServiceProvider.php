<?php

declare(strict_types=1);

namespace Src\Block\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Src\Block\Domain\Repository\BlockRepositoryInterface;
use Src\Block\Infrastructure\Persistence\BlockRepositoryPersistence;

class BlockServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(BlockRepositoryInterface::class, BlockRepositoryPersistence::class);
    }

}