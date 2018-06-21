<?php

namespace App\Parsers\Responses;

class WeatherResponseParser
{
    
    /**
     * it's going to receive the data that need to be parsed to an array of temperatures 
     */
    public static function parseData($data)
    {
        $obj = json_decode($data);

        $formatted['metadata']['city'] =  $obj->predictions->city;
        $formatted['metadata']['date'] =  $obj->predictions->date;
        $formatted['metadata']['scale'] = $obj->predictions->{'-scale'};
    
        foreach($obj->predictions->prediction as $prediction) {
            $formatted['predictions'][$prediction->time] =  $prediction->value;
        }

        return json_encode($formatted);
    }

    // Here is where we can change the query depending the Partner
    public static function getQueryURI($partner, $city, $date) {
        return $partner->getBaseURI() . '?city=' . strtolower($city) . '&date=' . $date;
    }

}