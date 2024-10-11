<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Exception;

use Exception;

class UserAlreadyAssignedToBlockException extends Exception
{
    protected $message = 'User is already assigned to this block.';
}