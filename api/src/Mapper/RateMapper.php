<?php

namespace App\Mapper;

use App\Entity\Rate;
use App\Model\RateListItem;

class RateMapper
{
    public static function map(Rate $rate, RateListItem $model): void
    {
        $model
            ->setId($rate->getId())
            ->setBase($rate->getBase())
            ->setRates($rate->getRates())
            ->setLastUpdate($rate->getLastUpdate());
    }
}
