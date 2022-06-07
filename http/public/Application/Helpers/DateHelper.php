<?php

namespace Application\Helpers;

class DateHelper
{
    public static function secToHR($seconds) {
        if ( $seconds == 0 ) return '00:00:00';
        $isInNegative = $seconds < 0;

        $abs = abs($seconds);

        $hours = floor($abs / 3600);
        $minutes = floor(($abs / 60) % 60);
        $seconds = $abs % 60;        
        $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
        $seconds = str_pad($seconds, 2, '0', STR_PAD_LEFT);

        return ($isInNegative ? '-' : '' ) . "$hours:$minutes:$seconds";
    }
}