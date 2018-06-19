<?php
declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Parsers\Temperatures\TemperatureParser;

final class TemperatureParserTest extends TestCase
{
    public function testConversionOfCelsiusToCelsius(): void
    {
        $temperature = 20; // celsius
        $convertedTemperature = TemperatureParser::convert($temperature, 'Celsius', 'Celsius');

        $this->assertEquals($temperature, $convertedTemperature);        
    }

    public function testConversionOfCelsiusToFahrenheit(): void
    {
        $temperature = 20; // celsius
        $convertedTemperature = TemperatureParser::convert($temperature, 'Celsius', 'Fahrenheit');

        $this->assertEquals(68, $convertedTemperature);
    }

    public function testConversionOfFahrenheitToCelsius(): void
    {
        $temperature = 68; // celsius
        $convertedTemperature = TemperatureParser::convert($temperature, 'Fahrenheit', 'Celsius');

        $this->assertEquals(20, $convertedTemperature);
    }

    public function testConversionOfFahrenheitToFahrenheit(): void
    {
        $temperature = 68; // fahrenheit
        $convertedTemperature = TemperatureParser::convert($temperature, 'Fahrenheit', 'Fahrenheit');

        $this->assertEquals(68, $convertedTemperature);
    }


}