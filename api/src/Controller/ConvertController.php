<?php

namespace App\Controller;

use App\Service\AnyApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ConvertController extends AbstractController
{
    public function __construct(private readonly AnyApiService $service)
    {
    }

    #[Route('/convert', name: 'convert', methods: ['POST'])]
    public function convert(Request $request): JsonResponse
    {
        return $this->json($this->service->convert($request));
    }




}
