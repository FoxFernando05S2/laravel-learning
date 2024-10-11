<?php

namespace Src\Profile\Domain\Exception;

use Exception;

class UserAlreadyHasProfileException extends Exception
{
    protected $message = 'User already has a profile.';

























    
    // public function render()
    // {
    //     return response()->json([
    //         'error' => $this->getMessage(),
    //     ], 400);
    // }
}
