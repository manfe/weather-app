<?php

namespace App\Controller\v1;

use App\Services\PredictionManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\DateValidator;
use App\Utils\ScaleValidator;
use App\Parsers\Temperatures\TemperatureParser;

class TemperatureController
{
    public function home()
    {
        return new Response(
            "<html><body>Welcome to Scribbr Weather API</body></html>"
        );
    }

    public function index($city, $date, $scale = 'celsius')
    {
        if (DateValidator::validateDate($date) && ScaleValidator::validateScale($scale)) {
            $prediction = PredictionManager::getPrediction($city, $date);
            return new JsonResponse($prediction->toArray($scale));
        } else {
            $scales = TemperatureParser::SUPPORTED_SCALES;
            $content = array('message' => "Invalid parameters, use the date format as 'yyyymmdd', also the supported scales are: " . implode($scales, ', '));
            return new JsonResponse($content, 400);
        }
        
    }

    public function nextTenDays($city, $scale = 'celsius')
    {
        if (ScaleValidator::validateScale($scale)) {
            $predictions = PredictionManager::getNextTenDaysPredictions($city, $scale);
            return new JsonResponse($predictions);
        } else {
            $scales = TemperatureParser::SUPPORTED_SCALES;
            $content = array('message' => "Invalid parameters, this city exist? or check if you are using the supported scales: " . implode($scales, ', '));
            return new JsonResponse($content, 400);
        }
        
    }

}