<?php

namespace App\Controller\v1;

use App\Services\PredictionManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
        $prediction = PredictionManager::getPrediction($city, $date);
        return new JsonResponse($prediction->toArray($scale));
    }

}