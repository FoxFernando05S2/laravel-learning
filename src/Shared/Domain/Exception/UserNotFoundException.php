<?php 

namespace Src\Shared\Domain\Exception;

class UserNotFoundException extends BaseException
{
    public function __construct()
    {
        parent::__construct('The user does not exist.', 404);
    }
}