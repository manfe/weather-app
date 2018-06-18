<?php

namespace App\Parsers;

class CelsiusParser
{
    
    /**
     * Receive the current temperature in celsius and convert to
     * the scale that is passing through param, it is going to return
     * integer since doesn't matter for final user the precision information (float, double).
    */
    public static function convert($temperature) : int
    {
        return $temperature;
    }

}