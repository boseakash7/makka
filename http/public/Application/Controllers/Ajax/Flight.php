<?php

namespace Application\Controllers\Ajax;

use Application\Models\Flights;
use Application\Models\Passenger;
use System\Core\Controller;
use System\Core\Exceptions\Error404;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Responses\JSON;

class Flight extends Controller
{
    public function check( Request $request, Response $response )
    {
        $id = $request->post('id');
        $flight = $request->post('flight');

        /**
         * @var Flights
         */
        $flightM = Model::get(Flights::class);
        $flight = $flightM->getById($flight);
        if ( empty($flight) ) throw new Error404();

        $status = Passenger::STATUS_CHECK_OUT;

        switch( $flight['status'] )
        {
            case Flights::STATUS_OPENED:
            case Flights::STATUS_CHECK_IN:
                $status = Passenger::STATUS_CHECK_IN;
                break;
        }

        /**
         * @var Passenger
         */
        $passM = Model::get(Passenger::class);

        $pass = $passM->find([ 'info' => $id, 'flight' => $flight['id'], 'status' => $status ]);
        if ( empty($pass) ) {
            $json = new JSON();
            $json->set(true);
        } else {
            $json = new JSON();
            $json->set(false);
        }

        $response->set($json);
    }

    public function add( Request $request, Response $response )
    {
        $id = $request->post('id');
        $flight = $request->post('flight');
        $special = $request->post('special');

        /**
         * @var Flights
         */
        $flightM = Model::get(Flights::class);
        $flight = $flightM->getById($flight);
        if ( empty($flight) ) throw new Error404();

        /**
         * @var Passenger
         */
        $passM = Model::get(Passenger::class);
        
        $status = Passenger::STATUS_CHECK_OUT;

        switch( $flight['status'] )
        {
            case Flights::STATUS_OPENED:
            case Flights::STATUS_CHECK_IN:
                $status = Passenger::STATUS_CHECK_IN;            
                break;
        }

        $passM->create([
            'flight' => $flight['id'],
            'info' => $id,
            'status' => $status,
            'special' => $special,
            'created_at' => time()
        ]);

        // update the flight status to check in
        $flightM->update($flight['id'], [
            'status' => $status
        ]);
        
        $json = new JSON();
        $json->set(true);

        $response->set($json);
    }
}