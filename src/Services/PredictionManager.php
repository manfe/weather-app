<?php

namespace App\Services;

use App\Entities\Prediction;
use \DatePeriod;
use \DateInterval;
use \DateTime;

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

    public static function getNextTenDaysPredictions($city, $scale = 'celsius') : array
    {
        $period = new DatePeriod(
            new DateTime('yesterday'),
            new DateInterval('P1D'),
            new DateTime('+ 8days')
        );

        $predictions;

        foreach ($period as $key => $value) {
            $date = $value->format('Ymd');

            // TODO: repeated code, need to abstract to a function, tic tac...
            if (array_key_exists("$city", self::$predictions) && 
                array_key_exists("$date", self::$predictions["$city"])) {

                $prediction = self::$predictions["$city"]["$date"];
                
                // if not valid
                if (! $prediction->isValid()) {
                    $prediction = PartnerResource::fetchTemperatures($prediction);
                    self::$predictions["$city"]["$date"] = $prediction;
                }
                
                $predictions["$date"] = self::$predictions["$city"]["$date"];
            } else {
                $prediction = new Prediction($city, $date);

                $prediction = PartnerResource::fetchTemperatures($prediction);
                self::$predictions["$city"]["$date"] = $prediction;
                $predictions["$date"] =  $prediction->getCalculatedTemperatures($scale);
            }
        }

        $formatted['metadata']['city'] = $city;
        $formatted['metadata']['scale'] = $scale;
        $formatted['predictions'] = $predictions;
            
        return $formatted;        
    }
}