<?php 

namespace Src\Profile\Domain\Exception;

use InvalidArgumentException;

class UserNotFoundException extends InvalidArgumentException
{
    protected $message = 'The user does not exist.';
}