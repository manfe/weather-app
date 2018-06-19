<?php
declare(strict_types=1);

namespace Tests\Unit;

use GuzzleHttp\Client;
use App\entities\Partner;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use App\Services\ConsumeTemperaturesAPI;

final class ExternalAPIParseTest extends TestCase
{

    public function testWeatherAPIConsumption(): void
    {
        $p = new Partner("Weather", 'http://weather.api.example.com/v1/temperatures', 'json');
        $client = new Client();
        $city = "Amsterdam";

        $body = file_get_contents(__DIR__ . '/../mocks/responses/temps.json');

        // Mocking Response
        $api = $this->getAPI($p, $client, $city, 200, $body);
        
        $apiResponse = $api->getData();

        var_dump($apiResponse);

        $this->assertEquals($body, $apiResponse);        
    }


    private function getAPI($p, $client, $city, $status, $body = null)
    {
        $mock = new MockHandler([new Response($status, [], $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
 
        return new ConsumeTemperaturesAPI($p, $client, $city);
    }

}