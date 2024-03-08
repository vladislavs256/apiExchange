<?php

namespace App\HttpClient;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\StreamInterface;

class AnyApiResponse
{
    private int             $statusCode;
    private StreamInterface $body;

    public function __construct(Response $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->body       = $response->getBody();
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent(): string
    {
        return (string) $this->body;
    }

    public function toArray(int $depth = 512, int $flags = 0): mixed
    {
        return json_decode($this->getContent(), true, $depth, $flags);
    }
}
