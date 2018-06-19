<?php

namespace App\Parsers;

class TemperatureParser {

    /**
     * Receive the current temperature in celsius and convert to
     * the scale that is passing through param, it is going to return
     * integer since doesn't matter for final user the precision information (float, double).
     * @param int $temperature the value that is going to be converted
     * @param string $fromScale the scale that the temperature is (eg. Celsius, Fahrenheit)
     * @param string $toScale the scale that the temperature is going to be converted  (eg. Celsius, Fahrenheit)
     */
    public static function convert($temperature, $fromScale = 'Celsius', $toScale = 'Celsius') : int
    {
        // avoiding typos
        $scale = strtolower($fromScale);

        $class = "App\\Parsers\\" . ucwords($fromScale) . "Parser";
        
        $parser = new $class(); // TODO: need create a better Exception if the class could not be found.
        
        return $parser->convert($temperature, $toScale);
    }

}