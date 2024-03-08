<?php

namespace App\Model;

class RateListItem
{
    private int $id;

    private int $lastUpdate;


    private string $base;

    private array $rates;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLastUpdate(): ?int
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(int $lastUpdate): static
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function setBase(string $base): static
    {
        $this->base = $base;

        return $this;
    }

    public function getRates(): array
    {
        return $this->rates;
    }

    public function setRates(array $rates): static
    {
        $this->rates = $rates;

        return $this;
    }
}
