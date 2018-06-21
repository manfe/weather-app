<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Entities\Partner;
use App\Entities\Prediction;
use App\Factories\PredictionFactory;
use App\Utils\ConsumeTemperaturesAPI;

class PartnerResource
{
    public static $partners = [];
    
    public static function init()
    {
        // TODO: This should come from a .env or some config file...
        array_push(self::$partners, new Partner('BBC', 'https://c2b4b124-a40e-4f39-8578-6f70dd43e6aa.mock.pstmn.io/bbc-temperatures'));// xml
        array_push(self::$partners, new Partner("Weather", 'https://c2b4b124-a40e-4f39-8578-6f70dd43e6aa.mock.pstmn.io/weather-temperatures')); // json
        array_push(self::$partners, new Partner("IAmsterdam", 'https://c2b4b124-a40e-4f39-8578-6f70dd43e6aa.mock.pstmn.io/iamsterdam-temperatures')); // csv
    }

    public static function fetchTemperatures(Prediction $prediction) : Prediction
    {
        self::init();

        $client = new Client();

        $responses = [];

        foreach(self::$partners as $p) {
            $api = new ConsumeTemperaturesAPI($p, $client, $prediction->getCity(), $prediction->getDate());
            $responses[] = $apiResponse = $api->getData();
        }

        foreach($responses as $r) {
            PredictionFactory::populateFromJSON($prediction, $r);
        }

        $prediction->setValidatedAt(strtotime("now"));

        return $prediction;
    }
}