<?php

namespace Application\Helpers;

use Application\Models\Airport;
use System\Core\Model;

class UserHelper {

    public static function prepare( $data )
    {
        if ( empty($data) ) return $data;

        $airportIds = [];

        foreach ( $data as $item )
        {
            $airportIds[$item['airport']] = $item['airport'];
        }

        /**
         * @var Airport
         */
        $aM = Model::get(Airport::class);
        $airports = $aM->getByIds($airportIds);

        foreach ( $data as & $item )
        {
            $item['airport'] = isset($airports[$item['airport']]) ? $airports[$item['airport']] :  null;
        }

        return $data;
    }
}