<?php

namespace App\Utils;

use GuzzleHttp\Client;
use App\entities\Partner;
use GuzzleHttp\Exception\ClientException;

// TODO: This class name looks ugly, maybe change it to a better one? idk
class ConsumeTemperaturesAPI
{
    private $partner;
    private $client;
    private $city;
    private $date;

    public function __construct(Partner $partner, Client $client, $city, $date)
    {
        $this->partner = $partner;
        $this->client = $client;
        $this->city = $city;
        $this->date = $date;
    }

    function getData()
    {
        $class = "App\\Parsers\\Responses\\" . $this->partner->getName() . "ResponseParser";
        $formattedURI = $class::getQueryURI($this->partner, $this->city, $this->date);

        try {
            // TODO: This request should be changed to AsyncRequest so we can work with promises
            // TODO: Also need to see the better way to implement the Guzzle Pool, to make concurrent requests
            $response = $this->client->request('GET', $formattedURI);
        } catch (ClientException $e) {
            throw new Exception("Failed to get the $this->city's temperatures from partner: " . $this->partner->getName());
        }
        
        $data = $response->getBody()->read(2048);

        return $class::parseData($data);
    }


}