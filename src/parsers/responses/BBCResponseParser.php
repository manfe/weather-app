<?php

namespace App\Parsers\Responses;

class BBCResponseParser
{
    
    /**
     * it's going to receive the data that need to be parsed to an array of temperatures 
     */
    public static function parseData($xml)
    {
        $obj = simplexml_load_string($xml);
        return $obj;
    }

    // Here is where we can change the query depending the Partner
    public static function getQueryURI($partner, $city) {
        return $partner->getBaseURI() . '?city=' . strtolower($city);
    }

}