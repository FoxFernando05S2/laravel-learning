<?php

namespace Src\Shared\Domain\Exception;

class UserAlreadyHasProfileException extends BaseException
{
    public function __construct()
    {
        parent::__construct('User already has a profile', 409);
    }
}