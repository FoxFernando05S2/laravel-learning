<?php 

declare(strict_types=1);

namespace Src\Type\Domain\Exception;

use Src\Shared\Domain\Exception\BaseException;

class TypeNotFoundException extends BaseException
{
    public function __construct()
    {
        parent::__construct('Type not found.', 404);
    }
}