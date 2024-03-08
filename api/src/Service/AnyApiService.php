<?php

namespace App\Service;

use App\Entity\Rate;
use App\HttpClient\DTO\Responses\ConvertCurrencyResults;
use App\HttpClient\DTO\Responses\RatesExchangeResults;
use App\HttpClient\Exceptions\AnyApiException;
use App\Resources\AnyApi\AnyApiResource;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class AnyApiService
{
    public function __construct(private AnyApiResource $anyApi, private EntityManagerInterface $em)
    {
    }    public function convert(Request $request): ConvertCurrencyResults
    {
        return $this->anyApi->convert($request);
    }

    public function getRates(Request $request): RatesExchangeResults
    {
        $response = $this->anyApi->rates($request);
        $this->saveRatesToDatabase($response);
        return $response;
    }

    private function saveRatesToDatabase(RatesExchangeResults $dto): void
    {
        $rate = (new Rate())
            ->setLastUpdate($dto->getLastUpdate())
            ->setBase($dto->getBase())
            ->setRates($dto->getRates());

        $this->em->persist($rate);
        $this->em->flush();
    }


    public function __call(string $name, array $params): void
    {
        throw new AnyApiException(
            [
                'message' => 'The specified resource does not exist',
                'code'    => 404,
                'reason'  => 'Resource not found',
            ]
        );
    }
}
