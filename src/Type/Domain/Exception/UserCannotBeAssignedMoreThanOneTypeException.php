<?php

declare(strict_types=1);

namespace Src\Type\Domain\Exception;

use Src\Shared\Domain\Exception\BaseException;

class UserCannotBeAssignedMoreThanOneTypeException extends BaseException
{
    public function __construct()
    {
        parent::__construct('User cannot be assigned more than one type if they are an "alumno".', 400);
    }
}