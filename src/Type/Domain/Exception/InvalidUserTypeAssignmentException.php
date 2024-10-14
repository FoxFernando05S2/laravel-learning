<?php

declare(strict_types=1);

namespace Src\Type\Domain\Exception;

use Src\Shared\Domain\Exception\BaseException;

class InvalidUserTypeAssignmentException extends BaseException
{
    public function __construct()
    {
        parent::__construct('User is a student, he cannot have another role', 400);
    }
}