<?php

namespace Application\Controllers;

use Application\Helpers\FlightHelper;
use Application\Main\AuthController;
use Application\Models\Airline;
use Application\Models\Airport;
use Application\Models\City;
use Application\Models\Flights as ModelsFlights;
use System\Core\Controller;
use System\Core\Exceptions\Error404;
use System\Core\Exceptions\Redirect;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Libs\FormValidator;
use System\Models\Language;
use System\Responses\View;

class Flights extends AuthController
{
    public function index( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $flightM = Model::get(ModelsFlights::class);
        $flights = $flightM->findAll([ 'sairport' => $userInfo['airport'] ]);
        $flights = FlightHelper::prepare($flights);

        $view = new View();
        $view->set('Flights/index', [
            'flights' => $flights
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function add( Request $request, Response $response )
    {

        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("flight");
        $formValidator->setRules([
            'number' => [
                'required' => true,
                'type' => 'string'
            ],
            'airlines' => [
                'required' => true,
                'type' => 'select'
            ],
            'date' => [
                'required' => true,
                'type' => 'string'
            ],
            'time' => [
                'required' => true,
                'type' => 'string'
            ],
            'passengers' => [
                'required' => true,
                'type' => 'number'
            ],
            'sairport' => [
                'required' => true,
                'type' => 'select'
            ],
            // 'dairport' => [
            //     'required' => true,
            //     'type' => 'select'
            // ],
        ])->setErrors([
            'number.required' => $lang('field_required'),
            'airlines.required' => $lang('field_required'),
            'date.required' => $lang('field_required'),
            'time.required' => $lang('field_required'),
            'passengers.required' => $lang('field_required'),
            'sairport.required' => $lang('field_required'),
            // 'dairport.required' => $lang('field_required'),
        ]);

        /**
         * @var Airline
         */
        $aM = Model::get(Airline::class);
        $airlines = $aM->all();

        /**
         * @var Airport
         */
        $airportM = Model::get(Airport::class);
        $sAirports = $airportM->findAll([ 'type' => Airport::TYPE_SOURCE ]);
        // $dAirports = $airportM->findAll([ 'type' => Airport::TYPE_DESTINATION ]);
        
        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $flightM = Model::get(ModelsFlights::class);
            $result = $flightM->create([
                'number' => $formValidator->getValue('number'),
                'airline' => $formValidator->getValue('airlines'),
                'tdate' => $formValidator->getValue('date'),
                'ttime' => $formValidator->getValue('time'),
                'passengers' => $formValidator->getValue('passengers'),
                'sairport' => $formValidator->getValue('sairport'),
                'dairport' => null,
                // 'dairport' => $formValidator->getValue('dairport'),
                'created_at' => time()
            ]);

            if ( $result ) throw new Redirect('flights');
        }

        $view = new View();
        $view->set('Flights/add', [
            'airlines' => $airlines,
            'sAirports' => $sAirports,
            // 'dAirports' => $dAirports
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function edit( Request $request, Response $response )
    {
        $param = $request->param(0);
        
        /**
         * @var ModelsFlights
         */
        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->getById( $param );
        

        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("flight");
        $formValidator->setRules([
            'number' => [
                'required' => true,
                'type' => 'string'
            ],
            'airlines' => [
                'required' => true,
                'type' => 'select'
            ],
            'date' => [
                'required' => true,
                'type' => 'string'
            ],
            'time' => [
                'required' => true,
                'type' => 'string'
            ],
            'passengers' => [
                'required' => true,
                'type' => 'number'
            ],
            'sairport' => [
                'required' => true,
                'type' => 'select'
            ],
            // 'dairport' => [
            //     'required' => true,
            //     'type' => 'select'
            // ],
        ])->setErrors([
            'number.required' => $lang('field_required'),
            'airlines.required' => $lang('field_required'),
            'date.required' => $lang('field_required'),
            'time.required' => $lang('field_required'),
            'passengers.required' => $lang('field_required'),
            'sairport.required' => $lang('field_required'),
            // 'dairport.required' => $lang('field_required')
        ]);

        /**
         * @var Airline
         */
        $aM = Model::get(Airline::class);
        $airlines = $aM->all();

        /**
         * @var Airport
         */
        $airportM = Model::get(Airport::class);
        $sAirports = $airportM->findAll([ 'type' => Airport::TYPE_SOURCE ]);
        
        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $result = $flightM->update($param, [
                'number' => $formValidator->getValue('number'),
                'airline' => $formValidator->getValue('airlines'),
                'tdate' => $formValidator->getValue('date'),
                'ttime' => $formValidator->getValue('time'),
                'passengers' => $formValidator->getValue('passengers'),
                'sairport' => $formValidator->getValue('sairport'),
                // 'dairport' => $formValidator->getValue('dairport'),
            ]);

            if ( $result ) throw new Redirect('flights');
        }

        $view = new View();
        $view->set('Flights/edit', [
            'airlines' => $airlines,
            'flight' => $flight,
            'sAirports' => $sAirports
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function open( Request $request, Response $response )
    {
        $id = $request->param(0);
        /**
         * @var ModelsFlights
         */
        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->find(['id' => $id]);
        if ( empty($flight) ) throw new Error404;

        // Update the flight status to open
        $flightM->update($flight['id'], [
            'status' => ModelsFlights::STATUS_OPENED
        ]);

        throw new Redirect('flights');
    }

    public function checkIn( Request $request, Response $response )
    {
        $id = $request->param(0);
        /**
         * @var ModelsFlights
         */
        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->find(['id' => $id]);
        if ( empty($flight) ) throw new Error404;

        // Update the flight status to open
        $flightM->update($flight['id'], [
            'status' => ModelsFlights::STATUS_CHECK_IN
        ]);

        throw new Redirect('flights/scan/' . $flight['id']);
    }

    public function checkOut( Request $request, Response $response )
    {
        $id = $request->param(0);
        /**
         * @var ModelsFlights
         */
        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->find(['id' => $id]);
        if ( empty($flight) ) throw new Error404;

        // Update the flight status to open
        $flightM->update($flight['id'], [
            'status' => ModelsFlights::STATUS_CHECK_OUT
        ]);

        throw new Redirect('flights/scan/' . $flight['id']);
    }

    public function scan( Request $request, Response $response )
    {
        $id = $request->param(0);
        /**
         * @var ModelsFlights
         */
        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->find(['id' => $id]);
        if ( empty($flight) ) throw new Error404;

        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        $view = new View();
        $view->set("Flights/scan", [
            'flight' => $flight
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }
}