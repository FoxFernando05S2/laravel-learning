<?php

return [
    App\Providers\AppServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    Src\User\Infrastructure\UserServiceProvider::class,
    Src\Profile\ProfileServiceProvider::class,
    Src\Block\Infrastructure\BlockServiceProvider::class,
    Src\Type\Infrastructure\TypeServiceProvider::class,

];
