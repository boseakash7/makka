<?php

namespace Application\Controllers;

use Application\Helpers\FlightHelper;
use Application\Main\AuthController;
use Application\Models\Airline;
use Application\Models\Airport;
use Application\Models\ArrivalAssesment;
use Application\Models\ArrivalForm;
use Application\Models\City;
use Application\Models\CounterTiming;
use Application\Models\DepartureAssesment;
use Application\Models\DepartureForm;
use Application\Models\Flights as ModelsFlights;
use Application\Models\Passenger;
use System\Core\Controller;
use System\Core\Exceptions\Error404;
use System\Core\Exceptions\Redirect;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Libs\FormValidator;
use System\Models\Language;
use System\Responses\View;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;

class Flights extends AuthController
{

    public function arrivalForm( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $param = $request->param(0);

        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->getById( $param );
        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        $arrivalAM = Model::get(ArrivalForm::class);
        $arrivalInfo = $arrivalAM->getByFlightId( $param );

        if( !empty($arrivalInfo) )
        {
            $arrivalInfo['arr'] = json_decode($arrivalInfo['json'], true);
        }

        $view = new View();
        $view->set('Flights/arrival_form', [
            'flight' => $flight,
            'arrivalInfo' => $arrivalInfo

        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function departureForm( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $param = $request->param(0);

        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->getById( $param );
        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        $departureAM = Model::get(DepartureForm::class);
        $departureInfo = $departureAM->getByFlightId( $param );

        if( !empty($departureInfo) )
        {
            $departureInfo['arr'] = json_decode($departureInfo['json'], true);
        }

        $view = new View();
        $view->set('Flights/departure_form', [
            'flight' => $flight,
            'departureInfo' => $departureInfo

        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function departureAssessment( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $param = $request->param(0);

        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->getById( $param );
        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        $departureAM = Model::get(DepartureAssesment::class);
        $departureInfos = $departureAM->getByFlightIdALL( $param );

        foreach( $departureInfos as &$departureInfo )
        {
            if( !empty($departureInfo) )
            {
                $departureInfo['arr'] = json_decode($departureInfo['json'], true);
            }

            switch ($departureInfo['lang']) {
                case 'en':
                    $departureInfo['langFull'] = 'English';
                    break;
                case 'arb':
                    $departureInfo['langFull'] = 'Arabic';
                    break;
                case 'pak':
                    $departureInfo['langFull'] = 'Pakistan';
                    break;
                case 'indo':
                    $departureInfo['langFull'] = 'Indonesia';
                    break;
                case 'malay':
                    $departureInfo['langFull'] = 'Malaysia';
                    break;
                case 'bng':
                    $departureInfo['langFull'] = 'Bangladesh';
                    break;

                default:
                    $departureInfo['langFull'] = 'English';
                    break;
            }
        }

        $view = new View();
        $view->set('Flights/departure_assessment', [
            'flight' => $flight,
            'departureInfos' => $departureInfos

        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function arrivalAssessment( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $param = $request->param(0);

        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->getById( $param );
        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        $arrivalAM = Model::get(ArrivalAssesment::class);
        $arrivalInfos = $arrivalAM->getByFlightIdAll( $param );

        foreach( $arrivalInfos as &$arrivalInfo )
        {
            if( !empty($arrivalInfo) )
            {
                $arrivalInfo['arr'] = json_decode($arrivalInfo['json'], true);
            }

            switch ($arrivalInfo['lang']) {
                case 'en':
                    $arrivalInfo['langFull'] = 'English';
                    break;
                case 'arb':
                    $arrivalInfo['langFull'] = 'Arabic';
                    break;
                case 'pak':
                    $arrivalInfo['langFull'] = 'Pakistan';
                    break;
                case 'indo':
                    $arrivalInfo['langFull'] = 'Indonesia';
                    break;
                case 'malay':
                    $arrivalInfo['langFull'] = 'Malaysia';
                    break;
                case 'bng':
                    $arrivalInfo['langFull'] = 'Bangladesh';
                    break;

                default:
                    $arrivalInfo['langFull'] = 'English';
                    break;
            }
        }

        $view = new View();
        $view->set('Flights/arrival_assessment', [
            'flight' => $flight,
            'arrivalInfos' => $arrivalInfos

        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }
    
    public function summary( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $param = $request->param(0);

        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->getById( $param );
        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        $view = new View();
        $view->set('Flights/summary', [
            'flight' => $flight
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function index( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $flightM = Model::get(ModelsFlights::class);
        $flights = $flightM->findAll([
            'sairport' => $userInfo['airport'],
            'status' => [
                ModelsFlights::STATUS_NOT_OPENED,
                ModelsFlights::STATUS_OPENED,
                ModelsFlights::STATUS_CHECK_IN,
                ModelsFlights::STATUS_CHECK_OUT,
                ModelsFlights::STATUS_CLOSED,
            ]
        ]);
        $flights = FlightHelper::prepare($flights);

        $view = new View();
        $view->set('Flights/index', [
            'flights' => $flights
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function all( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $flightM = Model::get(ModelsFlights::class);
        $flights = $flightM->all();
        $flights = FlightHelper::prepare($flights);

        $view = new View();
        $view->set('Flights/index', [
            'flights' => $flights
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function arrival( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $flightM = Model::get(ModelsFlights::class);
        $flights = $flightM->findAll([
            'dairport' => $userInfo['airport'],
            'status' => [
                ModelsFlights::STATUS_ON_AIR,
                ModelsFlights::STATUS_ARRIVED,
            ]
        ]);
        $flights = FlightHelper::prepare($flights);

        $view = new View();        
        $view->set('Flights/index', [
            'flights' => $flights,
            'arrival' => true
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function completed( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $flightM = Model::get(ModelsFlights::class);
        $flights = $flightM->findAll([
            'dairport' => $userInfo['airport'],
            'status' => [
                ModelsFlights::STATUS_COMPLETE
            ]
        ]);
        $flights = FlightHelper::prepare($flights);

        $view = new View();        
        $view->set('Flights/index', [
            'flights' => $flights,
            'arrival' => true
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function add( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

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
            'saudi_date' => [
                'required' => true,
                'type' => 'string'
            ],
            'saudi_time' => [
                'required' => true,
                'type' => 'string'
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
            'saudi_date.required' => $lang('field_required'),
            'saudi_time.required' => $lang('field_required'),
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
                'saudi_date' => $formValidator->getValue('saudi_date'),
                'saudi_time' => $formValidator->getValue('saudi_time'),
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
            'userInfo' => $userInfo
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
            'saudi_date' => [
                'required' => true,
                'type' => 'string'
            ],
            'saudi_time' => [
                'required' => true,
                'type' => 'string'
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
            'saudi_date.required' => $lang('field_required'),
            'saudi_time.required' => $lang('field_required'),     
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
                'saudi_date' => $formValidator->getValue('saudi_date'),
                'saudi_time' => $formValidator->getValue('saudi_time'),
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
        
        $counM = Model::get(CounterTiming::class);
        $counM->create([
            'flight' => $flight['id'],
            'date' => date('Y-m-d'),
            'time' => time(),
            'type' => CounterTiming::TYPE_OPEN
        ]);

        throw new Redirect('flights');
    }

    public function arrived( Request $request, Response $response )
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
            'status' => ModelsFlights::STATUS_ARRIVED
        ]);

        throw new Redirect('arrivals');
    }

    
    public function close( Request $request, Response $response )
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
            'status' => ModelsFlights::STATUS_CLOSED
        ]);

        $counM = Model::get(CounterTiming::class);
        $counM->create([
            'flight' => $flight['id'],
            'date' => date('Y-m-d'),
            'time' => time(),
            'type' => CounterTiming::TYPE_CLOSE
        ]);

        throw new Redirect('flights');
    }

    public function checkIn( Request $request, Response $response )
    {
        // $id = $request->param(0);
        // /**
        //  * @var ModelsFlights
        //  */
        // $flightM = Model::get(ModelsFlights::class);
        // $flight = $flightM->find(['id' => $id]);
        // if ( empty($flight) ) throw new Error404;

        // // Update the flight status to open
        // $flightM->update($flight['id'], [
        //     'status' => ModelsFlights::STATUS_CHECK_IN
        // ]);

        // throw new Redirect('flights/scan/' . $flight['id']);
    }

    public function checkOut( Request $request, Response $response )
    {
        // $id = $request->param(0);
        // /**
        //  * @var ModelsFlights
        //  */
        // $flightM = Model::get(ModelsFlights::class);
        // $flight = $flightM->find(['id' => $id]);
        // if ( empty($flight) ) throw new Error404;

        // // Update the flight status to open
        // $flightM->update($flight['id'], [
        //     'status' => ModelsFlights::STATUS_CHECK_OUT
        // ]);

        // throw new Redirect('flights/scan/' . $flight['id']);
    }

    public function scan( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $id = $request->param(0);
        $mode = $request->param(1);

        /**
         * @var ModelsFlights
         */
        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->find(['id' => $id]);
        if ( empty($flight) ) throw new Error404;

        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        $browserM = new Browser();
        $osM = new Os();

        $supports = true;
        if( $osM->getName() == 'iOS' )
        {
            if( $browserM->getName() != 'Safari' )
            {
                $supports = false;
            }
        }

        $view = new View();
        $view->set("Flights/scan", [
            'flight' => $flight,
            'supports' => $supports,
            'userInfo' => $userInfo,
            'mode' => $mode
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function log( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $id = $request->param(0);
        /**
         * @var ModelsFlights
         */
        $flightM = Model::get(ModelsFlights::class);
        $flight = $flightM->find(['id' => $id]);
        if ( empty($flight) ) throw new Error404;
        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        /**
         * @var Passenger
         */
        $pM = Model::get(Passenger::class);
        $passengers = $pM->findAll([ 'flight' => $flight['id']]);        

        $view  = new View();
        $view->set('Flights/log', [
            'flight' => $flight,
            'passengers' => $passengers
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }
}