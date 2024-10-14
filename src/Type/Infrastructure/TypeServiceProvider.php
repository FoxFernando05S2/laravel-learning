<?php

declare(strict_types=1);

namespace Src\Type\Infrastructure;


use Illuminate\Support\ServiceProvider;
use Src\Type\Domain\Repository\TypeRepositoryInterface;
use Src\Type\Infrastructure\Persistence\TypeRepositoryPersistence;

class TypeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TypeRepositoryInterface::class, TypeRepositoryPersistence::class );
    }

}