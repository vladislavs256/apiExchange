<?php

namespace App\HttpClient\DTO\Request;

use Symfony\Component\Validator\Constraints as Assert;

readonly class RatesExchangeRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public string    $base,
    ) {

    }
}
