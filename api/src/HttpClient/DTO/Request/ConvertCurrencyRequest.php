<?php

namespace App\HttpClient\DTO\Request;

use Symfony\Component\Validator\Constraints as Assert;

readonly class ConvertCurrencyRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public string    $base,
        #[Assert\NotBlank]
        public string    $to,
        #[Assert\NotBlank]
        public int|float $amount,
    ) {

    }
}
