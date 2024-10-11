<?php 

declare(strict_types=1);

namespace Src\User\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Src\User\Domain\Repository\UserRepositoryInterface;
use Src\User\Infrastructure\Persistence\UserRepositoryPersistence;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepositoryPersistence::class);
    }

}