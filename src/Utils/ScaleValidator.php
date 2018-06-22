<?php

namespace App\Utils;

use App\Parsers\Temperatures\TemperatureParser;

class ScaleValidator
{
    
    public static function validateScale($scale)
    {
        //need to check case
        $scale = strtolower($scale);
        $scale = ucwords($scale);

        return in_array($scale, TemperatureParser::SUPPORTED_SCALES);
    }

}