<?php

namespace App\Adapters\Infra\Http;

use Core\Infra\Http\IHttpClient;
use Core\Infra\Http\IHttpResponse;
use Illuminate\Support\Facades\Http;

final class LaravelHttpClient implements IHttpClient
{
    public function get(string $url, array $headers = []): IHttpResponse
    {
        $result = Http::withHeaders($headers)->get($url);
        return new LaravelHttpResponse($result);
    }
}
