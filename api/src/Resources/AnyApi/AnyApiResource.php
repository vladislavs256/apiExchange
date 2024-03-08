<?php

namespace App\Resources\AnyApi;

use App\HttpClient\DTO\Responses\ConvertCurrencyResults;
use App\HttpClient\DTO\Responses\RatesExchangeResults;
use App\HttpClient\Exceptions\AnyApiException;
use App\Resources\AbstractResource;
use JsonException;
use Symfony\Component\HttpFoundation\Request;

class AnyApiResource extends AbstractResource
{
    public const ANYAPI_API = 'api/v1/exchange/';

    public function getApiRoot(): string
    {
        return $_ENV['ANYAPI_HOST'] . self::ANYAPI_API;
    }

    /**
     * @throws AnyApiException
     * @throws JsonException
     */
    public function rates(Request $request): RatesExchangeResults
    {
        $this->validateParams($this, $request);
        $url = $this->buildApiUrl('rates', $request);
        return $this->adapter->handle('get', $url, RatesExchangeResults::class);
    }

    /**
     * @throws AnyApiException
     * @throws JsonException
     */
    public function convert(Request $request): ConvertCurrencyResults
    {
        $this->validateParams($this, $request);
        $url = $this->buildApiUrl('convert', $request);
        return $this->adapter->handle('get', $url, ConvertCurrencyResults::class);
    }
    protected function buildApiUrl(string $endpoint, Request $request): string
    {
        $queryParameters = http_build_query($request->request->all());
        return $this->getApiRoot() . $endpoint . '?' . $queryParameters . '&apiKey=' . $_ENV['ANY_API_KEY'];
    }



}
