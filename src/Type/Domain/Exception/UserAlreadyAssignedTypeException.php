<?php 

declare(strict_types=1);

namespace Src\Type\Domain\Exception;

use Src\Shared\Domain\Exception\BaseException;

class UserAlreadyAssignedTypeException extends BaseException
{
    public function __construct()
    {
        parent::__construct('User is already assigned to this type.', 400);
    }
}