<?php
declare(strict_types=1);

namespace Tests\Unit;

use GuzzleHttp\Client;
use App\entities\Partner;
use App\Entities\Prediction;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use App\Services\PartnerResource;
use App\Services\PredictionManager;
use GuzzleHttp\Handler\MockHandler;
use App\Factories\PredictionFactory;
use App\Utils\ConsumeTemperaturesAPI;

final class ExternalAPIParseTest extends TestCase
{

    // Partner that uses JSON on their API
    public function testWeatherAPIConsumption(): void
    {
        $p = new Partner("Weather", 'http://weather.api.example.com/v1/temperatures', 'json');
        $client = new Client();
        $city = "Amsterdam";

        // Mocking response body
        $body = file_get_contents(__DIR__ . '/../mocks/responses/temps.json');
        $expected = file_get_contents(__DIR__ . '/../mocks/responses/formatted_json_temps.json');

        // Mocking Response
        $api = $this->getAPI($p, $client, $city, 200, $body);
        
        $apiResponse = $api->getData();

        $this->assertEquals($this->removePrettyFormat($expected), 
                            $this->removePrettyFormat($apiResponse));        
    }

    // Partner that uses XML on their API
    public function testBBCAPIConsumption(): void
    {
        $p = new Partner("BBC", 'http://bbc.api.example.com/v2/temperatures', 'xml');
        $client = new Client();
        $city = "Groningen";

        // Mocking response body
        $body = file_get_contents(__DIR__ . '/../mocks/responses/temps.xml');
        $expected = file_get_contents(__DIR__ . '/../mocks/responses/formatted_xml_temps.json');

        // Mocking Response
        $api = $this->getAPI($p, $client, $city, 200, $body);
        
        $apiResponse = $api->getData();

        $this->assertEquals($this->removePrettyFormat($expected), 
                            $this->removePrettyFormat($apiResponse));
    }

    // Partner that uses CSV on their API
    public function testIAmsterdamAPIConsumption(): void
    {
        $p = new Partner("IAmsterdam", 'http://iamsterdam.api.example.com/v265/temperatures', 'csv');
        $client = new Client();
        $city = "Whatever";
        
        // Mocking response body
        $body = file_get_contents(__DIR__ . '/../mocks/responses/temps.csv');
        
        $expected = file_get_contents(__DIR__ . '/../mocks/responses/formatted_csv_temps.json');

        // Mocking Response
        $api = $this->getAPI($p, $client, $city, 200, $body);
        
        $apiResponse = $api->getData();

        $this->assertEquals($this->removePrettyFormat($expected), 
                            $this->removePrettyFormat($apiResponse));        
    }

    private function getAPI($p, $client, $city, $status, $body = null)
    {
        $mock = new MockHandler([new Response($status, [], $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $date = '20180620';
 
        return new ConsumeTemperaturesAPI($p, $client, $city, $date);
    }

    private function removePrettyFormat($data) 
    {
        return preg_replace( "/\r|\n|\s+/", "", $data);
    }

    

}