<?php

namespace Mdhesari\Nasiba\Traits;

use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

trait HttpClientTools
{
    public string $base_url;

    /**
     * @param string $url
     * @return string
     */
    private function url(string $url): string
    {
        return trim($this->base_url, '/').'/'.$url;
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    private function getResponse(ResponseInterface $response): mixed
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param ClientException $error
     * @return string
     */
    private function getErrorResponse(ClientException $error)
    {
        return json_decode($error->getResponse()->getBody()->getContents(), true);
    }
}
