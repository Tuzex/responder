<?php

declare(strict_types=1);

namespace Tuzex\Responder\Result;

use Tuzex\Responder\Http\Headers;
use Tuzex\Responder\Http\StatusCode;

final class HttpConfig
{
    private StatusCode $statusCode;
    private Headers $headers;

    public function __construct(StatusCode $statusCode, Headers $headers)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public static function set(int $statusCode, array $headers = []): self
    {
        return new self(
            new StatusCode($statusCode),
            new Headers(...$headers)
        );
    }

    public function getStatusCode(): int
    {
        return $this->statusCode->getCode();
    }

    public function getHeaders(): array
    {
        return $this->headers->all();
    }

    public function joinHeaders(Headers $headers): self
    {
        return new self($this->statusCode, $this->headers->unify($headers));
    }
}