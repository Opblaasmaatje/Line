<?php

namespace App\Wise\Client\Exceptions;

use Exception;

abstract class WiseOldManException extends Exception
{
    public function __construct(string|null $message = '')
    {
        $this->message = $message;

        parent::__construct($this->getMessage());
    }
}
