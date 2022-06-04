<?php

namespace Application\Helpers;

class DateHelper
{
    public static function secToHR($seconds) {
        if ( $seconds <= 0 ) return '00:00:00';
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;        
        $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
        $seconds = str_pad($seconds, 2, '0', STR_PAD_LEFT);
        return "$hours:$minutes:$seconds";
    }
}