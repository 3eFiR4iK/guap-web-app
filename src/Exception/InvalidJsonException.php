<?php

namespace App\Exception;

use RuntimeException;

class InvalidJsonException extends RuntimeException
{
    public function __construct()
    {
        $this->message = 'Client sent invalid JSON';

        parent::__construct($this->message);
    }
}
