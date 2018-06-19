<?php

namespace App\Parsers;

class FahrenheitParser
{
    
    /**
     * Receive the current temperature in celsius and convert to
     * the scale that is passing through param, it is going to return
     * integer since doesn't matter for final user the precision information (float, double).
     * @param int $temperature the value that is going to be converted it's always in Fahrenheit
     * @param string $toScale the scale that the temperature is going to be converted  (eg. Celsius, Fahrenheit)
     */
    public static function convert(int $temperature, $toScale) : int
    {
        switch ($toScale) {
            case 'Celsius':
                return ($temperature - 32) / 1.8;
                break;
            
            case 'Fahrenheit':
                return $temperature;
                break;
        }
    }

}