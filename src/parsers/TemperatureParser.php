<?php

namespace App\Parsers;

class TemperatureParser {

    /**
     * Receive the current temperature in celsius and convert to
     * the scale that is passing through param, it is going to return
     * integer since doesn't matter for final user the precision information (float, double).
     */
    public static function convert($temperature, $scale = 'Celsius') : int
    {
        // avoiding typos
        $scale = strtolower($scale);

        $class = "App\\Parsers\\" . ucwords($scale) . "Parser";
        
        $parser = new $class(); // TODO: here should throw an pretty error if the class could not be found.
        
        return $parser->convert($temperature, $scale);
    }

}