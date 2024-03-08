<?php

namespace App\Resources;

use App\HttpClient\AnyApiAdapter;
use App\HttpClient\Exceptions\AnyApiException;
use Symfony\Component\HttpFoundation\Request;
use TypeError;

abstract class AbstractResource
{
    protected AnyApiAdapter $adapter;
    public function __construct()
    {
        $this->adapter = new AnyApiAdapter($this);
    }
    abstract public function getApiRoot(): string;

    protected function validateParams(AbstractResource $dtoClass, Request $request): void
    {
        try {
            new $dtoClass($request);
        } catch (TypeError $e) {
            $error = [
                'reason' => 'Type error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
            throw new AnyApiException($error);
        }
    }

    /**
     * @throws AnyApiException
     */
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
