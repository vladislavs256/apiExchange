<?php

namespace App\HttpClient;

use App\HttpClient\Exceptions\AnyApiException;
use App\Resources\AbstractResource;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use JetBrains\PhpStorm\ArrayShape;
use JsonException;
use Mjelamanov\GuzzlePsr18\Client as Psr18GuzzleClient;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class AnyApiAdapter
{
    private ClientInterface $client;

    public function __construct(AbstractResource $resource)
    {
        $guzzleClient = new Client([
            'base_uri' => $resource->getApiRoot(),
            'headers' => [
                'User-Agent' => 'AnyApi SDK (PHP)/1.0',
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        $this->client = new Psr18GuzzleClient($guzzleClient);
    }

    /**
     * @throws AnyApiException
     * @throws JsonException
     */
    public function handle(string $httpMethod, string $url, string $responseDTOClass)
    {
        $error = [];

        try {
            $request = new Request($httpMethod, $url);
            $response = $this->client->sendRequest($request);
            $data = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            $status = $response->getStatusCode();
            if ($status !== 200) {
                $error = $this->generateError($data, $status);
            }
        } catch (ServerException $e) {
            $response = $e->getResponse();
            $data = json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            $error = $this->generateError($data, $e->getCode());
        } catch (ClientExceptionInterface $e) {
        }

        if ($error) {
            throw new AnyApiException($error);
        }

        return new $responseDTOClass($data);
    }

    public function get(string $url, array $options = []): AnyApiResponse
    {
        return $this->request('GET', $url, $options);
    }

    public function post(string $url, array $options = []): AnyApiResponse
    {
        return $this->request('POST', $url, $options);
    }

    private function request(string $method, $uri = '', array $options = []): AnyApiResponse
    {
        $method = strtolower($method);
        try {
            $response = $this->client->$method($uri, $options);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return new AnyApiResponse($response);
    }

    #[ArrayShape(['message' => "mixed", 'reason' => "mixed", 'code' => "mixed"])]
    public function generateError(array $data, int $status): array
    {
        if (array_key_exists('errors', $data)) {
            return [
                'message' => $data['errors'][0],
                'reason' => 'Bad Argument',
                'code' => 400,
            ];
        }


        return [
            'message' => 'Unknown errored response format',
            'reason' => 'Bad response',
            'code' => 0
        ];
    }
}
