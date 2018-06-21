<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Entities\Partner;
use App\Entities\Prediction;
use App\Factories\PredictionFactory;
use App\Utils\ConsumeTemperaturesAPI;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class PartnerResource
{
    public static $partners = [];
    
    public static function loadPartners()
    {
        $configDir = array(__DIR__.'/../../config');

        $fileLocator = new FileLocator($configDir);
        $yaml = $fileLocator->locate('partners.yaml', null, false);

        $partners = Yaml::parse(file_get_contents($yaml[0]));

        // it returns test, dev or production, depending the .env file.
        $env = getenv('APP_ENV');

        foreach($partners[$env] as $partner) {
            array_push(self::$partners, new Partner($partner['name'], $partner['base_uri'], $partner['format']));
        }
    }

    public static function fetchTemperatures(Prediction $prediction) : Prediction
    {
        self::loadPartners();

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