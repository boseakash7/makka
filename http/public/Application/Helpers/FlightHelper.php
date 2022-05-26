<?php

namespace Application\Helpers;

use Application\Models\Airline;
use Application\Models\Airport;
use System\Core\Model;

class FlightHelper {

    public static function prepare( $data )
    {
        if ( empty($data) ) return $data;

        $airline_ids = [];
        $airportIds = [];

        foreach ( $data as $item )
        {
            $airline_ids[$item['airline']] = $item['airline'];
            $airportIds[$item['sairport']] = $item['sairport'];
            $airportIds[$item['dairport']] = $item['dairport'];
        }

        /**
         * @var Airline
         */
        $aM = Model::get(Airline::class);
        $airlines = $aM->getByIds($airline_ids);

        /**
         * @var Airport
         */
        $airportM = Model::get(Airport::class);
        $airports = $airportM->getByIds($airportIds);

        foreach ( $data as & $item )
        {
            $item['airline'] = isset($airlines[$item['airline']]) ? $airlines[$item['airline']] : null;
            $item['sairport'] = isset($airports[$item['sairport']]) ? $airports[$item['sairport']] : null;
            $item['dairport'] = isset($airports[$item['dairport']]) ? $airports[$item['dairport']] : null;
        }

        return $data;
    }
}