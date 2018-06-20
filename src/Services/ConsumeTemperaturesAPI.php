<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\entities\Partner;
use GuzzleHttp\Exception\ClientException;

// TODO: This class name looks ugly, maybe change it to a better one? idk
class ConsumeTemperaturesAPI
{
    private $partner;
    private $client;
    private $city;

    public function __construct(Partner $partner, Client $client, $city)
    {
        $this->partner = $partner;
        $this->client = $client;
        $this->city = $city;
    }

    function getData()
    {
        $class = "App\\Parsers\\Responses\\" . $this->partner->getName() . "ResponseParser";
        $formattedURI = $class::getQueryURI($this->partner, $this->city);

        try {
            $response = $this->client->request('GET', $formattedURI);
        } catch (ClientException $e) {
            throw new Exception("Failed to get the $this->city's temperatures from partner: " . $this->partner->getName());
        }
        
        $data = $response->getBody()->read(2048);

        return $class::parseData($data);
    }


}