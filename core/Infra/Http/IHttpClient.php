<?php

namespace Core\Infra\Http;


interface IHttpClient
{
    public function get(string $url, array $headers = []): IHttpResponse;
}
