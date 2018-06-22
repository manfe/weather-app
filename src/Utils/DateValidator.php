<?php

namespace App\Utils;

use \DateTime;

class DateValidator
{
    
    public static function validateFormat($date, $format = 'Ymd')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public static function validateDate($date)
    {
        return strtotime('today') <= strtotime($date);
    }

}