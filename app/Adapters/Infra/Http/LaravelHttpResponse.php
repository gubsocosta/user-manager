<?php

namespace App\Adapters\Infra\Http;

use Core\Infra\Http\IHttpResponse;
use Illuminate\Http\Client\Response as HttpClientResponse;

class LaravelHttpResponse implements IHttpResponse
{
    public function __construct(private HttpClientResponse $response)
    {
    }

    public function setStatusCode(int $statusCode): void
    {
        $this->response->status($statusCode);
    }

    public function setHeaders(array $headers): void
    {
        $this->response->headers($headers);
    }

    public function setBody(string $body): void
    {
        $this->response->body($body);
    }

    public function getBody(): string
    {
        return $this->response->body();
    }

    public function getStatusCode(): int
    {
        return $this->response->status();
    }

    public function getHeaders(): array
    {
        return $this->response->headers();
    }
}
