<?php

namespace App\Parsers\Responses;

class BBCResponseParser
{
    
    /**
     * it's going to receive the data that need to be parsed to an array of temperatures 
     */
    public static function parseData($xml)
    {
        // when the partner uses a XML Structure, here is where we can put the logic to make it
        // work as we need in our application, I choosed the json format for it.
        $obj = simplexml_load_string($xml);
        $json = json_encode($obj);
        $array = json_decode($json,TRUE);
    
        $formatted['metadata']['city'] =  $array['city'];
        $formatted['metadata']['date'] =  $array['date'];
        $formatted['metadata']['scale'] = $array["@attributes"]["scale"];
    
        foreach($array['prediction'] as $prediction) {
            $formatted['predictions'][$prediction['time']] =  $prediction['value'];
        }

        return json_encode($formatted);
    }

    // Here is where we can change the query depending the Partner api structure/documentation
    public static function getQueryURI($partner, $city) {
        return $partner->getBaseURI() . '?city=' . strtolower($city);
    }

}