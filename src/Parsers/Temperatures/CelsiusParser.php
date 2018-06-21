<?php

namespace App\Parsers\Temperatures;

class CelsiusParser
{
    
    /**
     * Receive the current temperature in celsius and convert to
     * the scale that is passing through param, it is going to return
     * integer since doesn't matter for final user the precision information (float, double).
     * @param int $temperature the value that is going to be converted it's always in Celsius
     * @param string $toScale the scale that the temperature is going to be converted  (eg. Celsius, Fahrenheit)
     */
    public static function convert(int $temperature, $toScale) : int
    {
        // if need another parser formula, like Réaumur, Newton, Kelvin and Romer
        // just add a case for it.

        switch ($toScale) {
            case 'Celsius':
                return $temperature;
            
            case 'Fahrenheit':
                return $temperature * 1.8 + 32;
        }
        
    }

}