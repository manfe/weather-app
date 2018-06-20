<?php

namespace App\Parsers\Responses;

class IAmsterdamResponseParser
{
    
    /**
     * it's going to receive the data that need to be parsed to an array of temperatures 
     */
    public static function parseData($data)
    {
        $array = array_map("str_getcsv", explode("\n", $data));
        
        array_shift($array); // remove first line that doesn't is usefull for us.
        
        $formatted['metadata']['city'] =  $array[0][1];
        $formatted['metadata']['date'] =  $array[0][2];
        $formatted['metadata']['scale'] = $array[0][0];

        array_pop($array); // removed the last element since it's just comment stuff
    
        foreach($array as $prediction) {
            $formatted['predictions'][$prediction[3]] =  $prediction[4];
        }
        
        return json_encode($formatted);

    }

    // Here is where we can change the query depending the Partner
    public static function getQueryURI($partner, $city) {
        return $partner->getBaseURI() . '?c=' . strtolower($city);
    }

}