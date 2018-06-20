<?php

namespace App\Entities;

// This should be a model in an application
class Prediction
{
    private $city;
    private $valid;
    private $temperatures;

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function invalidate() {
        $this->valid = false;
    }

    public function isValid() {
        return $this->valid;
    }

    // here is where the calculation of average temperature is
    // going to happen, also note that should be always stored as Celsius
    public function setTemperature($hour, $temperature) {
        if ($this->temperature == null) {
            $this->temperature;
        } else { 
            $this->temperature = ($this->temperature + $temperature) / 2;
        }
    }

    public function getTemperature() {
        return $this->temperature;
    }

}