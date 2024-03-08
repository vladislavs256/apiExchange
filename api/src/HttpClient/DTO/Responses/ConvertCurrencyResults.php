<?php

namespace App\HttpClient\DTO\Responses;

use Symfony\Component\Validator\Constraints as Assert;

class ConvertCurrencyResults
{
    public function getBase(): string
    {
        return $this->base;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getConverted(): float
    {
        return $this->converted;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getLastUpdate(): int
    {
        return $this->lastUpdate;
    }
    public string $base;
    public string $to;
    public float $amount;
    public float $converted;
    public float $rate;
    public int $lastUpdate;

    public function __construct(array $data)
    {
        $this->base = $data['base'];
        $this->to = $data['to'];
        $this->amount = $data['amount'];
        $this->converted = $data['converted'];
        $this->rate = $data['rate'];
        $this->lastUpdate = $data['lastUpdate'];
    }

}
