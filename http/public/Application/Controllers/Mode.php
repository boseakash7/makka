<?php

namespace Application\Controllers;

use Application\Models\Flights;
use System\Core\Controller;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;

class Mode extends Controller
{
    public function index( Request $request, Response $response )
    {
        if( empty($request->get('flight_id')) || empty($request->get('status')) )
        {
            echo 'Please enter flight id and status in the url';
            exit;
        }

        $flightId = $request->get('flight_id');
        $status = $request->get('status');

        $flightM = Model::get(Flights::class);
        $flight = $flightM->getById($flightId);

        if( empty($flight) )
        {
            echo 'The flight id you entered is invalid';
            exit;
        }

        if( $status != Flights::STATUS_CHECK_IN && $status != Flights::STATUS_CHECK_OUT )
        {
            echo 'Please enter a valid status for the flight';
            exit;
        }

        $flightM->update( $flightId, array(
            'status' => $status
        ) );

        echo 'Flight Status has been successfully updated';
    }
}