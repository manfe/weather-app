<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Parsers\TemperatureParser;

final class TemperatureParserTest extends TestCase
{
    public function testConversionOfCelsiusToCelsius(): void
    {
        $temperature = 20; // celsius
        $convertedTemperature = TemperatureParser::convert($temperature);

        $this->assertEquals($temperature, $convertedTemperature);        
    }

    public function testConversionOfCelsiusToFahrenheit(): void
    {
        $temperature = 20; // celsius
        $convertedTemperature = TemperatureParser::convert($temperature, 'Fahrenheit');

        $this->assertEquals(68, $convertedTemperature);
    }




}