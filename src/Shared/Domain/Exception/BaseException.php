<?php 

declare(strict_types=1);

namespace   Src\Shared\Domain\Exception;

use Exception;

class BaseException extends Exception
{

    public function __construct(
        string $message = "",
        protected int $statusCode = 500,
        protected array $errors = [],
        Exception $previous = null
        ) 
    {
        parent::__construct($message,$statusCode,$previous);
        $this->errors[] = $message;
        $this->errors= array_merge($this->errors, $errors);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }


    public function getErrors(): array
    {
        return $this->errors;
    }
}