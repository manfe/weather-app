<?php

namespace App\Utils;

use \DateTime;

class DateValidator
{
    
    public static function validateDate($date, $format = 'Ymd')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

}