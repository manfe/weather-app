<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    public function testHomePageIsSuccessful()
    {
        $client = new Client();

        // The first request is intercepted with the first response.
        $status = $client->request('GET', getenv('BASE_URL'))->getStatusCode();

        $this->assertEquals($status, 200);
    }

    public function testTemperatureRequestV1IsSuccessful()
    {
        $client = new Client();

        // The first request is intercepted with the first response.
        $status = $client->request('GET', getenv('BASE_URL') . '/v1/temperatures/amsterdam/20180620')->getStatusCode();

        $this->assertEquals($status, 200);
    }


    public function testTemperature10DaysRequestV1IsSuccessful()
    {
        $client = new Client();

        // The first request is intercepted with the first response.
        $status = $client->request('GET', getenv('BASE_URL') . '/v1/temperatures/next-10-days/amsterdam')->getStatusCode();

        $this->assertEquals($status, 200);
    }

    public function testTemperature10DaysFahrenheitRequestV1IsSuccessful()
    {
        $client = new Client();

        // The first request is intercepted with the first response.
        $status = $client->request('GET', getenv('BASE_URL') . '/v1/temperatures/next-10-days/amsterdam/fahrenheit')->getStatusCode();

        $this->assertEquals($status, 200);
    }
}
