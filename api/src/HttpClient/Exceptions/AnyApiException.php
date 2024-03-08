<?php

namespace App\HttpClient\Exceptions;

use Exception;

class AnyApiException extends Exception
{
    private string $reason;

    public function __construct(array $error)
    {
        $this->reason = $error['reason'];

        parent::__construct($error['message'], $error['code']);
    }

    public function getReason(): string
    {
        return $this->reason;
    }
}
