<?php

namespace App\Model;

class RateListResponse
{
    /**
     * @param RateListItem[] $items
     */
    public function __construct(private readonly array $items)
    {
    }

    /**
     * @return RateListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
