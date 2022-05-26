<?php

namespace Application\Helpers;

use Application\Models\City;
use System\Core\Model;

class AirportHelper {

    public static function prepare( $data )
    {
        if ( empty($data) ) return $data;

        $cityIds = [];

        foreach ( $data as $item )
        {
            $cityIds[$item['city']] = $item['city'];
        }

        /**
         * @var City
         */
        $cM = Model::get(City::class);
        $cities = $cM->getByIds($cityIds);

        foreach ( $data as & $item )
        {
            $item['city'] = isset($cities[$item['city']]) ? $cities[$item['city']] :  null;
        }

        return $data;
    }
}