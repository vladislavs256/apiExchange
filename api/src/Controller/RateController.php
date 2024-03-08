<?php

namespace App\Controller;

use App\Entity\Rate;
use App\Mapper\RateMapper;
use App\Model\RateListItem;
use App\Model\RateListResponse;
use App\Repository\RateRepository;
use App\Service\RateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class RateController extends AbstractController
{
    public function __construct(
        private readonly RateService $rateService
    ) {

    }

    #[Route('/rates/{base}', name: 'rates', methods: ['GET'])]
    public function rateByBase(string $base): JsonResponse
    {
        return $this->json($this->rateService->getRatesByBase($base));
    }
}
