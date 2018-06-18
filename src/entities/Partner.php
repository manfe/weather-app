<?php

namespace App\entities;

/** this need to be a model in an application, so we can retrieve a list of partners  */

class WeatherPartner 
{

    private $name;
    private $baseUri;

    public construct($name, $baseUri)
    {
        $this->name = $name;
        $this->baseUri = $baseUri;
    }

    


}
