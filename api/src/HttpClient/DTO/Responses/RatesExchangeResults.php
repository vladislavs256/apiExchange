<?php

namespace App\HttpClient\DTO\Responses;

class RatesExchangeResults
{
    public function getLastUpdate(): int
    {
        return $this->lastUpdate;
    }

    public function getBase(): string
    {
        return $this->base;
    }

    public function getRates(): array
    {
        return $this->rates;
    }
    public int $lastUpdate;
    public string $base;
    public array $rates;

    public function __construct(array $data)
    {
        $this->lastUpdate = $data['lastUpdate'];
        $this->base = $data['base'];
        $this->rates = $data['rates'];
    }
}
