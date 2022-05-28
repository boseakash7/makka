<?php

namespace Application\Controllers\Ajax;

use Application\Models\Airport;
use System\Core\Controller;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Models\Language;
use System\Responses\JSON;

class Form extends Controller
{
    public function getAirportsByCity( Request $request, Response $response )
    {
        $city = $request->post('city');
        $type = $request->post('type');
        /**
         * @var Airport
         */
        $airportM = Model::get(Airport::class);
        $airports = $airportM->findAll([ 'city' => $city, 'type' => $type ]);

        $lang = Model::get(Language::class);

        $option = '';
        if ( empty( $airports ) )
        {
            $option .= '<option value="">' . $lang('select_airport') . '</option>';
        } else {
            foreach ( $airports as $airport )
            {
                $option .= '<option value="' . $airport['id'] . '">' . $airport[$lang->current() . '_name'] . '</option>';
            }
        }

        $json = new JSON();
        $json->set([
            'info' => 'success',
            'payload' => $option
        ]);

        $response->set($json);
    }
}