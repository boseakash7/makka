<?php


namespace Application\Helpers;

class Number {
    public static function pretty( $number )
    {
        return number_format($number, 0, '.', ',');
    }
}