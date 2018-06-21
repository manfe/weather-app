<?php

namespace App\Factories;

use App\Entities\Prediction;

class PredictionFactory
{
    
    /**
     *  The json should come with the normalized structure
     *  Check tests/mocks/responses/formated* to see it
     */
    public static function buildFromJSON($json) : Prediction
    {
        $obj = json_decode($json);

        $prediction = new Prediction;
        $prediction->setCity($obj->metadata->city);
        $prediction->setDate($obj->metadata->date);

        foreach ($obj->predictions as $hour => $temperature) {
            $prediction->setTemperature($hour, $temperature, $obj->metadata->scale);
        }

        return $prediction;
    }

    public static function populateFromJSON(Prediction $prediction, $json) : Prediction
    {
        $obj = json_decode($json);

        foreach ($obj->predictions as $hour => $temperature) {
            $prediction->setTemperature($hour, $temperature, $obj->metadata->scale);
        }

        return $prediction;
    }

}