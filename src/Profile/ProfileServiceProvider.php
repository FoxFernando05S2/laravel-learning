<?php

declare(strict_types=1);

namespace Src\Profile;

use Illuminate\Support\ServiceProvider;
use Src\Profile\Domain\Repository\ProfileRepositoryInterface;
use Src\Profile\Infrastructure\Persistence\ProfileRepositoryPersistences;



class ProfileServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ProfileRepositoryInterface::class, ProfileRepositoryPersistences::class );
    }

}