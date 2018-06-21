<?php

namespace App\Services;

use App\Entities\Prediction;
use Psr\Log\LoggerInterface;

/**
 * This class basicly work as a database key, value.
 * I was going to use memcached here, but the time is running out.
 */
class PredictionManager
{
    private $logger;
    static $predictions = [];
    
    public static function getPrediction($city, $date) : Prediction
    {
        if (array_key_exists("$city", self::$predictions) && 
            array_key_exists("$date", self::$predictions["$city"])) {

            $prediction = self::$predictions["$city"]["$date"];
            
            // if not valid
            if (! $prediction->isValid()) {
                $prediction = PartnerResource::fetchTemperatures($prediction);
                self::$predictions["$city"]["$date"] = $prediction;
            }
            
            return self::$predictions["$city"]["$date"];
        } else {
            $prediction = new Prediction($city, $date);

            $prediction = PartnerResource::fetchTemperatures($prediction);
            self::$predictions["$city"]["$date"] = $prediction;
            return $prediction;
        }
    }
}