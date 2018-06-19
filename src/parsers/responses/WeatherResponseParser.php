<?php

namespace App\Parsers\Responses;

class WeatherResponseParser
{
    
    /**
     * it's going to receive the data that need to be parsed to an array of temperatures 
     */
    public static function parseData($data)
    {
        return json_decode($data);
    }

    // Here is where we can change the query depending the Partner
    public static function getQueryURI($partner, $city) {
        return $partner->getBaseURI() . '?city=' . strtolower($city);
    }

}