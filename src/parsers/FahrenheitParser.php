<?php

namespace App\Parsers;

class FahrenheitParser
{
    
    /**
     * Receive the current temperature in celsius and convert to
     * the scale that is passing through param, it is going to return
     * integer since doesn't matter for final user the precision information (float, double).
    */
    public static function convert(int $temperature) : int
    {
        echo $temperature;

        return $temperature * 1.8 + 32;
    }

}