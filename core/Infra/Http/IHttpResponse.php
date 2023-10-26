<?php

namespace Core\Infra\Http;

interface IHttpResponse
{
    public function setStatusCode(int $statusCode): void;

    public function getStatusCode(): int;

    public function setHeaders(array $headers): void;

    public function getHeaders(): array;

    public function setBody(string $body): void;

    public function getBody(): string;
}
