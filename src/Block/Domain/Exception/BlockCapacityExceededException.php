<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Exception;

use Exception;

class BlockCapacityExceededException extends Exception
{
    protected $message = 'Block capacity has been exceeded.';
}