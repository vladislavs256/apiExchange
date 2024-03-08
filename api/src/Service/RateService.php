<?php

namespace App\Service;

use App\Entity\Rate;
use App\Mapper\RateMapper;
use App\Model\RateListItem;
use App\Model\RateListResponse;
use App\Repository\RateRepository;

readonly class RateService
{
    public function __construct(
        private RateRepository $rateRepository
    ) {
    }
    public function getRatesByBase(string $base): RateListResponse
    {
        return new RateListResponse(array_map(
            function (Rate $rate) {
                $item = new RateListItem();
                RateMapper::map($rate, $item);
                return $item;
            },
            $this->rateRepository->findByBaseName($base)
        ));
    }
}
