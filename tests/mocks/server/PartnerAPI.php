<?php

namespace Tests\Mocks\Server;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Exception\RequestException;

class PartnerAPI
{

    public static function temperatures() {

        $body = fopen(__DIR__ . '/../responses/temps.json', 'r');

        $mock = new MockHandler([
            new Response(200, [], $body)
        ]);
        
        $handler = HandlerStack::create($mock);

        $client = new Client(['handler' => $handler]);
        
        $json = $client->request('GET', '/api')->getBody()->read(1024);

        return $json;
    }

}