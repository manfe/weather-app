<?php

namespace App\Api;

use App\entities\WeatherPartner as Partner;

class WeatherFromAPI
{
    private $partner;
    private $format;
    private $

    function __construct(Partner $partner, $format = 'json')
    {
        $this->partner = $partner;
        $this->format = $format;
    }

    function getData()
    {
        throw Exception('Method not implemented yet.');
    }


}