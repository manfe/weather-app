<?php

namespace App\Entities;

use App\Parsers\Temperatures\TemperatureParser;

// This should be a model in an application
class Prediction
{
    private $city;
    private $date;
    private $validatedAt;
    private $temperatures = [];

    public function __construct($city, $date) 
    {
        $this->city = $city;
        $this->date = $date;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setValidatedAt($datetime) {
        $this->validatedAt = $datetime;
    }

    public function isValid() {
        // if true need refetch the data from partners
        ($this->validatedAt <= strtotime("-10 minutes")) ? false : true;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getDate() {
        return $this->date;
    }

    public function toArray($scale) {
        $formatted['metadata']['city'] =  $this->city;
        $formatted['metadata']['date'] =  $this->date;
        $formatted['metadata']['scale'] = $scale;
        $formatted['predictions'] =  $this->getCalculatedTemperatures($scale);
    
        return $formatted;
    }

    public function setTemperature($hour, $temperature, $scale) {
        // convert the temperature to celsiu before store it
        $celsiusTemperature = TemperatureParser::convert($temperature, $scale, TemperatureParser::CELSIUS);

        // assign temperature value to the list of temperatures
        return $this->temperatures["$hour"][] = $celsiusTemperature;
    }

    public function getCalculatedTemperatures($format = TemperatureParser::CELSIUS) {
        $temps = [];

        foreach($this->temperatures as $hour => $temperatures) {
            $temperature = array_sum($temperatures) / count($temperatures);

            $temps["$hour"] = TemperatureParser::convert($temperature, TemperatureParser::CELSIUS, $format);
        }
        
        return $temps;
    }

    public function getTemperatureByHour($hour) {
        return $this->temperatures["$hour"];
    }
    
}