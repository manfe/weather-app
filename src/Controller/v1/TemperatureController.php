<?php

namespace App\Controller\v1;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemperatureController
{
    public function home()
    {
        return new Response(
            "<html><body>Welcome to Scribbr Weather API</body></html>"
        );
    }

    public function index($city, $scale)
    {
        return new Response(
            "<html><body>Lucky number: $city, $scale</body></html>"
        );
    }

    private function getCurrentDate() {
        $date = new DateTime();
        return $date->format('Ymd');
    }
}