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
use System\Responses\View;

class Flight extends Controller
{
    public function logUpdate( Request $request, Response $response )
    {
        $passengerId = $request->post('id');
        $check_in = $request->post('check_in');
        $check_out = $request->post('check_out');

        Model::get(Passenger::class)->update( $passengerId, [
            'check_in_time' => strtotime($check_in),
            'check_out_time' => strtotime($check_out)
        ] );

        $json = new JSON();
        $json->set([
            'check_in' => date('Y-m-d H:i:s', strtotime($check_in)),
            'check_out' => date('Y-m-d H:i:s', strtotime($check_out))
        ]);

        $response->set($json);
    }

    public function logModal( Request $request, Response $response )
    {
        $passengerId = $request->post('id');

        $passengerInfo = Model::get(Passenger::class)->find(['id' => $passengerId]);

        $view = new View();
        $view->set('Flights/Modal/log_update', [
            'passengerInfo' => $passengerInfo
        ]);
        $output = $view->content();

        $json = new JSON();
        $json->set(['payload' => $output]);

        $response->set($json);
    }

    public function check( Request $request, Response $response )
    {
        $id = $request->post('id');
        $flight = $request->post('flight');
        $mode = $request->post('mode');

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

        $pass = $passM->find([ 'info' => $id, 'flight' => $flight['id'] ]);
        $isValid = true;

        if ( !empty($pass) )
        {
            if ( $mode == 'check-in' )
            {
                if ( !empty($pass['check_in_time']) ) {
                    $isValid = false;
                }else {
                    $isValid = true;
                }
            } else {
                if ( !empty($pass['check_out_time']) ) {
                    $isValid = false;
                } else {
                    $isValid = true;
                }
            }
        }

        $json = new JSON();
        $json->set($isValid);

        $response->set($json);
    }

    public function add( Request $request, Response $response )
    {
        $id = $request->post('id');
        $flight = $request->post('flight');
        $special = $request->post('special');
        $mode = $request->post('mode');

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
        $pass = $passM->find([ 'info' => $id, 'flight' => $flight['id'] ]);        
        if ( !empty($pass) )
        {
            if ( $mode == 'check-in' )
            {
                $passM->update($pass['id'], [
                    'check_in_time' => time()
                ]);
            } else {
                $passM->update($pass['id'], [
                    'check_out_time' => time()
                ]);
            }
            
        } else {
            $passM->create([
                'flight' => $flight['id'],
                'info' => $id,
                'check_in_time' => $mode == 'check-in' ? time() : null,
                'check_out_time' => $mode == 'check-out' ? time() : null,
                'special' => $special,
                'created_at' => time()
            ]);
        }

        switch( $flight['status'] )
        {
            case Flights::STATUS_OPENED:
            case Flights::STATUS_CHECK_IN:
                $flightM->update($flight['id'], [
                    'status' => $mode == 'check-in' ? Flights::STATUS_CHECK_IN : Flights::STATUS_CHECK_OUT
                ]);
        }
        
        
        $json = new JSON();
        $json->set(true);

        $response->set($json);
    }

    public function canScan( Request $request, Response $response )
    {
        $id = $request->post('flightId');

        /**
         * @var Flights
         */
        $flightM = Model::get(Flights::class);
        $flight = $flightM->getById($id);
        if ( empty($flight) ) throw new Error404();

        $isValid = false;
        switch( $flight['status'] )
        {
            case Flights::STATUS_CHECK_IN:
            case Flights::STATUS_CHECK_OUT:
            case Flights::STATUS_OPENED:
                $isValid = true;
                break;
        }

        $json = new JSON();
        $json->set($isValid);

        $response->set($json);
    }
}