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
use System\Responses\File;

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

        $arrivalFlightInfo = '';
        $takeOffPlace = '';

        if( !empty($arrivalInfo) )
        {
            $arrivalInfo['arr'] = json_decode($arrivalInfo['json'], true);

            $arrivalFlightInfo = Model::get(City::class)->find(['id' => $arrivalInfo['arr']['arrival_city']]);
            $takeOffPlace = Model::get(City::class)->find(['id' => $arrivalInfo['arr']['take_off_place']]);
        }

        $view = new View();
        $view->set('Flights/arrival_form', [
            'flight' => $flight,
            'arrivalInfo' => $arrivalInfo,
            'arrivalFlightInfo' => $arrivalFlightInfo,
            'takeOffPlace' => $takeOffPlace,

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
            $departureCityInfo = Model::get(City::class)->find(['id' => $departureInfo['arr']['departure_city']]);
        }

        $view = new View();
        $view->set('Flights/departure_form', [
            'flight' => $flight,
            'departureInfo' => $departureInfo,
            'departureCityInfo' => $departureCityInfo

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

    public function export( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $flightM = Model::get(ModelsFlights::class);
        $flights = $flightM->all();
        $flights = FlightHelper::prepare($flights);

        /**
         * @var \Application\Models\Language
         */
        $lang = Model::get(Language::class);
       
        $response->setHeaders([
            'Content-Type: text/csv; charset=utf-8',
            'content-Disposition: attachment; filename=flights.csv'
        ]);

        $output = fopen("php://output", "w");

        fputcsv($output, array(
            $lang('id'),
            $lang('flight_number'),
            $lang('airlines'),
            $lang('take_off_date'),
            $lang('take_off_time'),
            $lang('saudi_date'),
            $lang('saudi_time'),
            $lang('number_of_passengers'),
            $lang('status'),
            $lang('source'),
            $lang('destination'),
            $lang('departure_date'),
            $lang('departure_time'),
            $lang('departure_city'),
            $lang('passengers'),
            $lang('arrival_city'),
            $lang('arrival_time'),
            $lang('working_counts'),
            $lang('non_working_counts'),
            $lang('average_pilgrim_waiting'),
            $lang('average_pilgrim_service'),
            $lang('counters_working_start_time'),
            $lang('counters_working_end_time'),
            $lang('number_of_men'),
            $lang('number_of_women'),
            $lang('number_of_seats') ,
            $lang('number_of_cases'),
            $lang('number_of_people_fingerprinted'),
            $lang('number_of_bags'),
            $lang('fingerprint_status'),
            $lang('connection_status'),
            $lang('speed_of_communication'),
            $lang('challenges'),
            $lang('treatment'),
            $lang('recommendations') ,
            $lang('reviews'),
            $lang('arrival_date'),
            $lang('arrival_city'),
            $lang('number_of_staffs'),
            $lang('number_of_counter_custom_staffs'),
            $lang('arrival_time'),
            $lang('take_off_place'),
            $lang('expected_arrival_time'),
            $lang('average_waiting_time_unitil_access'),
            $lang('average_waiting_time_unitil_end_of_inspection'),
            $lang('average_waiting_until_sorting_system'),
            $lang('how_long_does_luggage_arrive_at'),
            $lang('duration_of_arrival_pilgrims'),
            $lang('flight_delay'),
            $lang('number_of_buses_operated_to_transport_pilgrims'),
            $lang('number_of_buses_operating_with_mecca_logo'),
            $lang('are_there_unmarked_buses'),
            $lang('are_there_any_accidents'),
            $lang('number_of_cases'),
            $lang('challenges'),
            $lang('solutions'),
            $lang('recommendations'),
            $lang('reviews')
        ));

        $departureAM = Model::get(DepartureForm::class);

        foreach ($flights as $flight) 
        {
            $departureInfo = $departureAM->getByFlightId( $flight['id'] );

            if( !empty($departureInfo) )
            {   
                $departureInfo['arr'] = json_decode($departureInfo['json'], true);

                $departureCityInfo = Model::get(City::class)->find(['id' => $departureInfo['arr']['departure_city']]);
            }

            $arrivalAM = Model::get(ArrivalForm::class);
            $arrivalInfo = $arrivalAM->getByFlightId( $flight['id'] );

            if( !empty($arrivalInfo) )
            {
                $arrivalInfo['arr'] = json_decode($arrivalInfo['json'], true);

                $arrivalFlightInfo = Model::get(City::class)->find(['id' => $arrivalInfo['arr']['arrival_city']]);
                $takeOffPlace = Model::get(City::class)->find(['id' => $arrivalInfo['arr']['take_off_place']]);
            }
            
            $list = array(
                $flight['id'],
                $flight['number'],
                $flight['airline']['en_name'] . '/' . $flight['airline']['ar_name'],
                $flight['tdate'],
                $flight['ttime'],
                $flight['saudi_date'],
                $flight['saudi_time'],
                $flight['passengers'],
                $lang($flight['status']),
                $flight['sairport']['en_name'] . '/' . $flight['sairport']['ar_name'],
                $flight['dairport']['en_name'] . '/' . $flight['dairport']['ar_name'],
                isset($departureInfo['arr']['date']) ? $departureInfo['arr']['date'] : '-',
                isset($departureInfo['arr']['departure_time']) ? $departureInfo['arr']['departure_time'] : '-',
                isset($departureCityInfo['en_name']) ? $departureCityInfo['en_name'] .'/' . $departureCityInfo['ar_name'] : '-',
                isset($departureInfo['arr']['passengers']) ? $departureInfo['arr']['passengers'] : '-',
                isset($departureInfo['arr']['arrival_city']) ? $departureInfo['arr']['arrival_city'] : '-',
                isset($departureInfo['arr']['arrival_time']) ? $departureInfo['arr']['arrival_time'] : '-',
                isset($departureInfo['arr']['working_counts']) ? $departureInfo['arr']['working_counts'] : '-',
                isset($departureInfo['arr']['non_working_counts']) ? $departureInfo['arr']['non_working_counts'] : '-',
                isset($departureInfo['arr']['average_pilgrim_waiting']) ? $departureInfo['arr']['average_pilgrim_waiting'] : '-',
                isset($departureInfo['arr']['average_pilgrim_service']) ? $departureInfo['arr']['average_pilgrim_service'] : '-',
                isset($departureInfo['arr']['counters_working_start_time']) ? $departureInfo['arr']['counters_working_start_time'] : '-',
                isset($departureInfo['arr']['counters_working_end_time']) ? $departureInfo['arr']['counters_working_end_time'] : '-',
                isset($departureInfo['arr']['number_of_men']) ? $departureInfo['arr']['number_of_men'] : '-',
                isset($departureInfo['arr']['number_of_women']) ? $departureInfo['arr']['number_of_women'] : '-',   
                isset($departureInfo['arr']['number_of_seats']) ? $departureInfo['arr']['number_of_seats'] : '-',   
                isset($departureInfo['arr']['number_of_cases']) ? $departureInfo['arr']['number_of_cases'] : '-',   
                isset($departureInfo['arr']['number_of_people_fingerprinted']) ? $departureInfo['arr']['number_of_people_fingerprinted'] : '-',    
                isset($departureInfo['arr']['number_of_bags']) ? $departureInfo['arr']['number_of_bags'] : '-',    
                isset($departureInfo['arr']['fingerprint_status']) ? $departureInfo['arr']['fingerprint_status'] : '-',    
                isset($departureInfo['arr']['connection_status']) ? $departureInfo['arr']['connection_status'] : '-', 
                isset($departureInfo['arr']['speed_of_communication']) ? $departureInfo['arr']['speed_of_communication'] : '-',    
                isset($departureInfo['arr']['challenges']) ? $departureInfo['arr']['challenges'] : '-',    
                isset($departureInfo['arr']['treatment']) ? $departureInfo['arr']['treatment'] : '-', 
                isset($departureInfo['arr']['recommendations']) ? $departureInfo['arr']['recommendations'] : '-',   
                isset($departureInfo['arr']['reviews'] ) ? $departureInfo['arr']['reviews']  : '-',
                isset($arrivalInfo['arr']['date'] ) ? $arrivalInfo['arr']['date']  : '-',
                isset($arrivalFlightInfo[$lang->current() . '_name'] ) ? $arrivalFlightInfo['en_name']  .'/' . $arrivalFlightInfo['ar_name']  : '-',
                isset($arrivalInfo['arr']['number_of_staffs']) ? $arrivalInfo['arr']['number_of_staffs'] : '-',
                isset($arrivalInfo['arr']['number_of_counter_custom_staffs']) ? $arrivalInfo['arr']['number_of_counter_custom_staffs'] : '-',
                isset($arrivalInfo['arr']['arrival_time']) ? $arrivalInfo['arr']['arrival_time'] : '-',
                isset($takeOffPlace[$lang->current() . '_name']) ? $takeOffPlace['en_name']  .'/' . $takeOffPlace['ar_name'] : '-',
                isset($arrivalInfo['arr']['expected_arrival_time']) ? $arrivalInfo['arr']['expected_arrival_time'] : '-',
                isset($arrivalInfo['arr']['average_waiting_time_unitil_access']) ? $arrivalInfo['arr']['average_waiting_time_unitil_access'] : '-',
                isset($arrivalInfo['arr']['average_waiting_time_unitil_end_of_inspection']) ? $arrivalInfo['arr']['average_waiting_time_unitil_end_of_inspection'] : '-',
                isset($arrivalInfo['arr']['average_waiting_until_sorting_system']) ? $arrivalInfo['arr']['average_waiting_until_sorting_system'] : '-',
                isset($arrivalInfo['arr']['how_long_does_luggage_arrive_at']) ? $arrivalInfo['arr']['how_long_does_luggage_arrive_at'] : '-',
                isset($arrivalInfo['arr']['duration_of_arrival_pilgrims']) ? $arrivalInfo['arr']['duration_of_arrival_pilgrims'] : '-',
                isset($arrivalInfo['arr']['flight_delay']) ? $lang($arrivalInfo['arr']['flight_delay']) : '-',
                isset($arrivalInfo['arr']['number_of_buses_operated_to_transport_pilgrims']) ? $arrivalInfo['arr']['number_of_buses_operated_to_transport_pilgrims'] : '-',
                isset($arrivalInfo['arr']['number_of_buses_operating_with_mecca_logo']) ? $arrivalInfo['arr']['number_of_buses_operating_with_mecca_logo'] : '-',
                isset($arrivalInfo['arr']['are_there_unmarked_buses']) ? $arrivalInfo['arr']['are_there_unmarked_buses'] : '-',
                isset($arrivalInfo['arr']['are_there_any_accidents']) ? $arrivalInfo['arr']['are_there_any_accidents'] : '-',
                isset($arrivalInfo['arr']['number_of_cases']) ? $arrivalInfo['arr']['number_of_cases'] : '-',
                isset($arrivalInfo['arr']['challenges']) ? $arrivalInfo['arr']['challenges'] : '-',
                isset($arrivalInfo['arr']['solutions']) ? $arrivalInfo['arr']['solutions'] : '-',
                isset($arrivalInfo['arr']['recommendations']) ? $arrivalInfo['arr']['recommendations'] : '-',
                isset($arrivalInfo['arr']['reviews']) ? $arrivalInfo['arr']['reviews'] : '-',

                

            );
            fputcsv($output, $list);
        }
        
        fclose($output);
        
        $file = new File('text/csv');
        $file->set($output);
        return $response->set($file);
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