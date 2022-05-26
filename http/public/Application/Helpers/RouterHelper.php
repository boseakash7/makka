<?php

namespace Application\Helpers;

use System\Helpers\URL;

class RouterHelper
{
    public static function has( $string )
    {
        $pos =  strpos(URL::current(), $string);        
        return $pos !== FALSE;
    }
}