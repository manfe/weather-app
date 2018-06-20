<?php

namespace App\Controller\v1;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TemperatureController
{
    public function index()
    {
        return new Response(
            '<html><body>Lucky number: 12</body></html>'
        );
    }
}