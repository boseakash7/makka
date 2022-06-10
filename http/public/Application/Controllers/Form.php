<?php

namespace Application\Controllers;

use Application\Controllers\Ajax\Flight;
use Application\Helpers\AirportHelper;
use Application\Helpers\DateHelper;
use Application\Helpers\FlightHelper;
use Application\Main\AuthController;
use Application\Models\Airport;
use Application\Models\ArrivalAssesment;
use Application\Models\ArrivalForm;
use Application\Models\City;
use Application\Models\DepartureAssesment;
use Application\Models\DepartureForm;
use Application\Models\Flights;
use Application\Models\User;
use System\Core\Controller;
use System\Core\Exceptions\Redirect;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Libs\FormValidator;
use System\Models\Language;
use System\Responses\View;

class Form extends Controller
{

    public function departureAssesment( Request $request, Response $response )
    {

        $lang = Model::get(Language::class);

        $userInfo = Model::get(User::class)->getInfo();

        $flightId = $request->param(0);
        $flightM = Model::get(Flights::class);
        $flight = $flightM->getById( $flightId );
        $flight = FlightHelper::prepare(array($flight));
        $flight = $flight[0];

        $selectedLang = 'en';

        if( $request->get('lang') )
        {
            $selectedLang = $request->get('lang');
        }

        $formValidator = FormValidator::instance("departure-assesment");
        $formValidator->setRules([
            'employment_interaction' => [
                'required' => true,
                'type' => 'string',
            ],
            'clarity_procedure' => [
                'required' => true,
                'type' => 'string',
            ],
            'service_provided' => [
                'required' => true,
                'type' => 'string',
            ],
            'awareness' => [
                'required' => true,
                'type' => 'string',
            ],
            'makkah_hall' => [
                'required' => true,
                'type' => 'string',
            ],
        ])->setErrors([
            'employment_interaction.required' => $lang('field_required'),
            'clarity_procedure.required' => $lang('field_required'),
            'service_provided.required' => $lang('field_required'),
            'awareness.required' => $lang('field_required'),
            'makkah_hall.required' => $lang('field_required'),
        ]);

        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {

            $data = [
                'employment_interaction' => $formValidator->getValue('employment_interaction'),
                'clarity_procedure' => $formValidator->getValue('clarity_procedure'),
                'service_provided' => $formValidator->getValue('service_provided'),
                'awareness' => $formValidator->getValue('awareness'),
                'makkah_hall' => $formValidator->getValue('makkah_hall'),
            ];

            $point = $this->_getpoint($data['employment_interaction']);
            $point += $this->_getpoint($data['clarity_procedure']);
            $point += $this->_getpoint($data['service_provided']);
            $point += $this->_getpoint($data['awareness']);
            $point += $this->_getpoint($data['makkah_hall']);

            $point = round($point / 5);

            $json = json_encode($data);

            $arrivalAM = Model::get(DepartureAssesment::class);
            $arrivalAM->create([
                'flight_id' => $flightId,
                'user_id' => $userInfo['id'],
                'json' => $json,
                'avg_score' =>  $point,
                'lang' => $selectedLang,
                'created_at' => time()
            ]);

            throw new Redirect('departure-assesment-form-success/' . $flightId );
        }

        $view = new View();
        $view->set('Form/departure_assesment', [
            'selectedLang' => $selectedLang,
            'flight' => $flight
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function arrivalAssesment( Request $request, Response $response )
    {

        $lang = Model::get(Language::class);

        $userInfo = Model::get(User::class)->getInfo();

        $flightId = $request->param(0);
        $flightM = Model::get(Flights::class);
        $flight = $flightM->getById( $flightId );
        $flight = FlightHelper::prepare(array($flight));
        $flight = $flight[0];

        
        $selectedLang = 'en';

        if( $request->get('lang') )
        {
            $selectedLang = $request->get('lang');
        }


        $formValidator = FormValidator::instance("arrival-assesment");
        $formValidator->setRules([
            'employment_interaction' => [
                'required' => true,
                'type' => 'string',
            ],
            'clarity_procedure' => [
                'required' => true,
                'type' => 'string',
            ],
            'service_provided' => [
                'required' => true,
                'type' => 'string',
            ],
        ])->setErrors([
            'employment_interaction.required' => $lang('field_required'),
            'clarity_procedure.required' => $lang('field_required'),
            'service_provided.required' => $lang('field_required'),
        ]);

        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {

            $data = [
                'employment_interaction' => $formValidator->getValue('employment_interaction'),
                'clarity_procedure' => $formValidator->getValue('clarity_procedure'),
                'service_provided' => $formValidator->getValue('service_provided'),
            ];

            $point = $this->_getpoint($data['employment_interaction']);
            $point += $this->_getpoint($data['clarity_procedure']);
            $point += $this->_getpoint($data['service_provided']);

            $point = round($point / 3);

            $json = json_encode($data);

            $arrivalAM = Model::get(ArrivalAssesment::class);
            $arrivalAM->create([
                'flight_id' => $flightId,
                'user_id' => $userInfo['id'],
                'json' => $json,
                'lang' => $selectedLang,
                'avg_score' => $point,
                'created_at' => time()
            ]);

            throw new Redirect('arrival-assesment-form-success/' . $flightId);
        }

        $view = new View();
        $view->set('Form/arrival_assesment', [
            'selectedLang' => $selectedLang,
            'flight' => $flight
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }
    
    
    public function arrivalAssesmentSuccess( Request $request, Response $response )
    {
        $id = $request->param(0);

        $view = new View();
        $view->set('Form/arrival_assesment_success', [
            'id' => $id
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function departureAssesmentSuccess( Request $request, Response $response )
    {
        $id = $request->param(0);

        $view = new View();
        $view->set('Form/departure_assesment_success', [
            'id' => $id
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function arrivalSuccess( Request $request, Response $response )
    {
        $view = new View();
        $view->set('Form/arrival_success', []);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function departureSuccess( Request $request, Response $response )
    {
        $view = new View();
        $view->set('Form/departure_success', []);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function arrival( Request $request, Response $response )
    {
        $lang = Model::get(Language::class);
        
        $flightId = $request->param(0);
        $flightInfo = Model::get(Flights::class)->getById($flightId);
        $flightInfo = FlightHelper::prepare([$flightInfo]);
        $flightInfo = $flightInfo[0];

        $cityM = Model::get(City::class);
        $cities = $cityM->all();

        $airportM = Model::get(Airport::class);
        $airports = $airportM->findAll([
            'type' => Airport::TYPE_SOURCE
        ]);

        $formValidator = FormValidator::instance("arrival-form");
        $formValidator->setRules([
            'date' => [
                'required' => true,
                'type' => 'string',
            ],
            'flight_delay' => [
                'required' => true,
                'type' => 'string',
            ],
            'arrival_city' => [
                'required' => true,
                'type' => 'string',
            ],
            'flight_number' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_staffs' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_counter_custom_staffs' => [
                'required' => true,
                'type' => 'string',
            ],
            'passengers' => [
                'required' => true,
                'type' => 'string',
            ],
            'arrival_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'take_off_place' => [
                'required' => true,
                'type' => 'string',
            ],
            'expected_arrival_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'average_waiting_time_unitil_access' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'average_waiting_time_unitil_end_of_inspection' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'average_waiting_until_sorting_system' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'how_long_does_luggage_arrive_at' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'first_hajji_arrived_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'last_hajji_arrived_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'first_bus_leave_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_buses_operated_to_transport_pilgrims' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_buses_operating_with_mecca_logo' => [
                'required' => true,
                'type' => 'string',
            ],
            'are_there_unmarked_buses' => [
                'type' => 'string',
            ],
            'are_there_any_accidents' => [
                'type' => 'string',
            ],
            'number_of_cases' => [
                'type' => 'string',
            ],
            'challenges' => [
                'type' => 'string',
            ],
            'solutions' => [
                'type' => 'string',
            ],
            'recommendations' => [
                'type' => 'string',
            ],
            'reviews' => [
                'type' => 'string',
            ],
        ])->setErrors([
            'flight_delay.required' => $lang('field_required'),
            'date.required' => $lang('field_required'),
            'arrival_city.required' => $lang('field_required'),
            'flight_number.required' => $lang('field_required'),
            'number_of_staffs.required' => $lang('field_required'),
            'number_of_counter_custom_staffs.required' => $lang('field_required'),
            'passengers.required' => $lang('field_required'),
            'arrival_time.required' => $lang('field_required'),
            'take_off_place.required' => $lang('field_required'),
            'expected_arrival_time.required' => $lang('field_required'),
            'average_waiting_time_unitil_access.required' => $lang('field_required'),
            'average_waiting_time_unitil_access.pattern' => $lang('field_invalid'),
            'average_waiting_time_unitil_end_of_inspection.required' => $lang('field_required'),
            'average_waiting_time_unitil_end_of_inspection.pattern' => $lang('field_invalid'),
            'average_waiting_until_sorting_system.required' => $lang('field_required'),
            'average_waiting_until_sorting_system.pattern' => $lang('field_invalid'),
            'how_long_does_luggage_arrive_at.required' => $lang('field_required'),
            'how_long_does_luggage_arrive_at.pattern' => $lang('field_invalid'),
            'first_hajji_arrived_time.required' => $lang('field_required'),
            'last_hajji_arrived_time.required' => $lang('field_required'),
            'first_bus_leave_time.required' => $lang('field_required'),
            'number_of_buses_operated_to_transport_pilgrims.required' => $lang('field_required'),
            'number_of_buses_operating_with_mecca_logo.required' => $lang('field_required'),
        ]);

        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $data = [
                'flight_delay' => $formValidator->getValue('flight_delay') ,
                'date' => $formValidator->getValue('date') ,
                'arrival_city' => $formValidator->getValue('arrival_city') ,
                'flight_number' => $formValidator->getValue('flight_number') ,
                'number_of_staffs' => $formValidator->getValue('number_of_staffs') ,
                'number_of_counter_custom_staffs' => $formValidator->getValue('number_of_counter_custom_staffs') ,
                'passengers' => $formValidator->getValue('passengers') ,
                'arrival_time' => $formValidator->getValue('arrival_time') ,
                'take_off_place' => $formValidator->getValue('take_off_place') ,
                'expected_arrival_time' => $formValidator->getValue('expected_arrival_time') ,
                'average_waiting_time_unitil_access' => $formValidator->getValue('average_waiting_time_unitil_access') ,
                'average_waiting_time_unitil_end_of_inspection' => $formValidator->getValue('average_waiting_time_unitil_end_of_inspection') ,
                'average_waiting_until_sorting_system' => $formValidator->getValue('average_waiting_until_sorting_system') ,
                'how_long_does_luggage_arrive_at' => $formValidator->getValue('how_long_does_luggage_arrive_at') ,
                'first_hajji_arrived_time' => $formValidator->getValue('first_hajji_arrived_time') ,
                'last_hajji_arrived_time' => $formValidator->getValue('last_hajji_arrived_time') ,
                'first_bus_leave_time' => $formValidator->getValue('first_bus_leave_time') ,
                'number_of_buses_operated_to_transport_pilgrims' => $formValidator->getValue('number_of_buses_operated_to_transport_pilgrims') ,
                'number_of_buses_operating_with_mecca_logo' => $formValidator->getValue('number_of_buses_operating_with_mecca_logo') ,
                'are_there_unmarked_buses' => $formValidator->getValue('are_there_unmarked_buses') ,
                'are_there_any_accidents' => $formValidator->getValue('are_there_any_accidents') ,
                'number_of_cases' => $formValidator->getValue('number_of_cases') ,
                'challenges' => $formValidator->getValue('challenges') ,
                'solutions' => $formValidator->getValue('solutions') ,
                'recommendations' => $formValidator->getValue('recommendations') ,
                'reviews' => $formValidator->getValue('reviews') ,
            ];

            $json = json_encode($data);

            $departureFM = Model::get(ArrivalForm::class);
            $departureFM->create([
                'flight_id' => $flightId,
                'json' => $json,
                'passengers' => $formValidator->getValue('passengers'),
                'average_waiting_to_sterile' => DateHelper::timeToSec($formValidator->getValue('average_waiting_time_unitil_access')),
                'average_waiting_inspection' => DateHelper::timeToSec( $formValidator->getValue('average_waiting_time_unitil_end_of_inspection') ),
                'average_luggage_arrive' =>  DateHelper::timeToSec($formValidator->getValue('how_long_does_luggage_arrive_at') ),
                'average_bus_ride' => DateHelper::timeToSec($formValidator->getValue('average_waiting_until_sorting_system') ),
                'flight_delay' => $this->_getPositive($formValidator->getValue('flight_delay')),
                'unmarked_buses' => $this->_getPositive($formValidator->getValue('are_there_unmarked_buses')),
                'accidents' => $this->_getPositive($formValidator->getValue('are_there_any_accidents')),
                'buses_ready_to_pilgrims' => $formValidator->getValue('number_of_buses_operated_to_transport_pilgrims'),
                'buses_with_mecca_logo' => $formValidator->getValue('number_of_buses_operating_with_mecca_logo'),
                'sick_cases' => $formValidator->getValue('number_of_cases'),
                'created_at' => time()
            ]);

            Model::get(Flights::class)->update($flightId, [
                'status' => Flights::STATUS_COMPLETE
            ]);

            throw new Redirect('arrival-form-success');
        }

        $view = new View();
        $view->set("Form/arrival", [
            'flightInfo' => $flightInfo,
            'cities' => $cities,
            'airports' => $airports
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function arrivalEdit( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $lang = Model::get(Language::class);

        $param = $request->param(0);

        $flightM = Model::get(Flights::class);

        $cityM = Model::get(City::class);
        $cities = $cityM->all();
        
        $flightM = Model::get(Flights::class);
        $flight = $flightM->getById( $param );
        $flight = FlightHelper::prepare([$flight]);
        $flight = $flight[0];

        $arrivalAM = Model::get(ArrivalForm::class);
        $arrivalInfo = $arrivalAM->getByFlightId( $param );

        if( !empty($arrivalInfo) )
        {
            $arrivalInfo['arr'] = json_decode($arrivalInfo['json'], true);
        }
        
        $flightInfo = Model::get(Flights::class)->getById($arrivalInfo['flight_id']);
        $flightInfo = FlightHelper::prepare([$flightInfo]);
        $flightInfo = $flightInfo[0];
        
        $destinationAirports = Model::get(Airport::class)->findAll(['city' => $arrivalInfo['arr']['arrival_city'], 'type' => Airport::TYPE_DESTINATION]);

        $formValidator = FormValidator::instance("edit-arrival-form");
        $formValidator->setRules([
            'date' => [
                'required' => true,
                'type' => 'string',
            ],
            'flight_delay' => [
                'required' => true,
                'type' => 'string',
            ],
            'arrival_city' => [
                'required' => true,
                'type' => 'string',
            ],
            'flight_number' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_staffs' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_counter_custom_staffs' => [
                'required' => true,
                'type' => 'string',
            ],
            'passengers' => [
                'required' => true,
                'type' => 'string',
            ],
            'arrival_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'take_off_place' => [
                'required' => true,
                'type' => 'string',
            ],
            'expected_arrival_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'average_waiting_time_unitil_access' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'average_waiting_time_unitil_end_of_inspection' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'average_waiting_until_sorting_system' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'how_long_does_luggage_arrive_at' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'first_hajji_arrived_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'last_hajji_arrived_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'first_bus_leave_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_buses_operated_to_transport_pilgrims' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_buses_operating_with_mecca_logo' => [
                'required' => true,
                'type' => 'string',
            ],
            'are_there_unmarked_buses' => [
                'type' => 'string',
            ],
            'are_there_any_accidents' => [
                'type' => 'string',
            ],
            'number_of_cases' => [
                'type' => 'string',
            ],
            'challenges' => [
                'type' => 'string',
            ],
            'solutions' => [
                'type' => 'string',
            ],
            'recommendations' => [
                'type' => 'string',
            ],
            'reviews' => [
                'type' => 'string',
            ],
        ])->setErrors([
            'flight_delay.required' => $lang('field_required'),
            'date.required' => $lang('field_required'),
            'arrival_city.required' => $lang('field_required'),
            'flight_number.required' => $lang('field_required'),
            'number_of_staffs.required' => $lang('field_required'),
            'number_of_counter_custom_staffs.required' => $lang('field_required'),
            'passengers.required' => $lang('field_required'),
            'arrival_time.required' => $lang('field_required'),
            'take_off_place.required' => $lang('field_required'),
            'expected_arrival_time.required' => $lang('field_required'),
            'average_waiting_time_unitil_access.required' => $lang('field_required'),
            'average_waiting_time_unitil_access.pattern' => $lang('field_invalid'),
            'average_waiting_time_unitil_end_of_inspection.required' => $lang('field_required'),
            'average_waiting_time_unitil_end_of_inspection.pattern' => $lang('field_invalid'),
            'average_waiting_until_sorting_system.required' => $lang('field_required'),
            'average_waiting_until_sorting_system.pattern' => $lang('field_invalid'),
            'how_long_does_luggage_arrive_at.required' => $lang('field_required'),
            'how_long_does_luggage_arrive_at.pattern' => $lang('field_invalid'),
            'first_hajji_arrived_time.required' => $lang('field_required'),
            'last_hajji_arrived_time.required' => $lang('field_required'),
            'first_bus_leave_time.required' => $lang('field_required'),
            'number_of_buses_operated_to_transport_pilgrims.required' => $lang('field_required'),
            'number_of_buses_operating_with_mecca_logo.required' => $lang('field_required'),
        ]);

        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $data = [
                'flight_delay' => $formValidator->getValue('flight_delay') ,
                'date' => $formValidator->getValue('date') ,
                'arrival_city' => $formValidator->getValue('arrival_city') ,
                'flight_number' => $formValidator->getValue('flight_number') ,
                'number_of_staffs' => $formValidator->getValue('number_of_staffs') ,
                'number_of_counter_custom_staffs' => $formValidator->getValue('number_of_counter_custom_staffs') ,
                'passengers' => $formValidator->getValue('passengers') ,
                'arrival_time' => $formValidator->getValue('arrival_time') ,
                'take_off_place' => $formValidator->getValue('take_off_place') ,
                'expected_arrival_time' => $formValidator->getValue('expected_arrival_time') ,
                'average_waiting_time_unitil_access' => $formValidator->getValue('average_waiting_time_unitil_access') ,
                'average_waiting_time_unitil_end_of_inspection' => $formValidator->getValue('average_waiting_time_unitil_end_of_inspection') ,
                'average_waiting_until_sorting_system' => $formValidator->getValue('average_waiting_until_sorting_system') ,
                'how_long_does_luggage_arrive_at' => $formValidator->getValue('how_long_does_luggage_arrive_at') ,
                'first_hajji_arrived_time' => $formValidator->getValue('first_hajji_arrived_time') ,
                'last_hajji_arrived_time' => $formValidator->getValue('last_hajji_arrived_time') ,
                'first_bus_leave_time' => $formValidator->getValue('first_bus_leave_time') ,
                'number_of_buses_operated_to_transport_pilgrims' => $formValidator->getValue('number_of_buses_operated_to_transport_pilgrims') ,
                'number_of_buses_operating_with_mecca_logo' => $formValidator->getValue('number_of_buses_operating_with_mecca_logo') ,
                'are_there_unmarked_buses' => $formValidator->getValue('are_there_unmarked_buses') ,
                'are_there_any_accidents' => $formValidator->getValue('are_there_any_accidents') ,
                'number_of_cases' => $formValidator->getValue('number_of_cases') ,
                'challenges' => $formValidator->getValue('challenges') ,
                'solutions' => $formValidator->getValue('solutions') ,
                'recommendations' => $formValidator->getValue('recommendations') ,
                'reviews' => $formValidator->getValue('reviews') ,
            ];

            $json = json_encode($data);

            $departureFM = Model::get(ArrivalForm::class);
            $departureFM->update( $arrivalInfo['id'] ,[
                'flight_id' => $arrivalInfo['flight_id'],
                'json' => $json,
                'passengers' => $formValidator->getValue('passengers'),
                'average_waiting_to_sterile' => DateHelper::timeToSec($formValidator->getValue('average_waiting_time_unitil_access')),
                'average_waiting_inspection' =>DateHelper::timeToSec( $formValidator->getValue('average_waiting_time_unitil_end_of_inspection') ),
                'average_luggage_arrive' => DateHelper::timeToSec($formValidator->getValue('how_long_does_luggage_arrive_at') ),
                'average_bus_ride' => DateHelper::timeToSec($formValidator->getValue('average_waiting_until_sorting_system') ),
                'duration_pilgrims' => 0,
                'flight_delay' => $this->_getPositive($formValidator->getValue('flight_delay')),
                'unmarked_buses' => $this->_getPositive($formValidator->getValue('are_there_unmarked_buses')),
                'accidents' => $this->_getPositive($formValidator->getValue('are_there_any_accidents')),
                'buses_ready_to_pilgrims' => $formValidator->getValue('number_of_buses_operated_to_transport_pilgrims'),
                'buses_with_mecca_logo' => $formValidator->getValue('number_of_buses_operating_with_mecca_logo'),
                'sick_cases' => $formValidator->getValue('number_of_cases'),
                'created_at' => time()
            ]);

            Model::get(Flights::class)->update($arrivalInfo['flight_id'], [
                'status' => Flights::STATUS_COMPLETE
            ]);

            throw new Redirect('flights/arrival-form/' . $arrivalInfo['flight_id']);
        }

        $view = new View();
        $view->set('Form/edit_arrival', [
            'flightInfo' => $flightInfo,
            'cities' => $cities,
            'arrivalInfo' => $arrivalInfo,
            'destinationAirports' => $destinationAirports

        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function departure( Request $request, Response $response )
    {
        $lang = Model::get(Language::class);
        
        $flightId = $request->param(0);
        $flightInfo = Model::get(Flights::class)->getById($flightId);
        $flightInfo = FlightHelper::prepare([$flightInfo]);
        $flightInfo = $flightInfo[0];

        $cityM = Model::get(City::class);
        $cities = $cityM->all();

        $airportM = Model::get(Airport::class);
        $airports = $airportM->findAll([
            'type' => Airport::TYPE_DESTINATION
        ]);

        $formValidator = FormValidator::instance("departure-form");
        $formValidator->setRules([
            'date' => [
                'required' => true,
                'type' => 'string',
            ],
            'departure_city' => [
                'required' => true,
                'type' => 'string',
            ],
            'departure_airport' => [
                'required' => true,
                'type' => 'select'
            ],
            'flight_number' => [
                'required' => true,
                'type' => 'string',
            ],
            'passengers' => [
                'required' => true,
                'type' => 'string',
            ],
            'departure_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'arrival_city' => [
                'required' => true,
                'type' => 'string',
            ],
            'arrival_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'working_counts' => [
                'required' => true,
                'type' => 'string',
            ],
            'non_working_counts' => [
                'required' => true,
                'type' => 'string',
            ],
            'average_pilgrim_waiting' => [
                'required' => true,
                'type' => 'string',
            ],
            'average_pilgrim_service' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'counters_working_start_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'counters_working_end_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_men' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_women' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_seats' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_cases' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_people_fingerprinted' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_bags' => [
                'type' => 'string',
            ],
            'fingerprint_status' => [
                'required' => true,
                'type' => 'string',
            ],
            'fingerprint_status' => [
                'required' => true,
                'type' => 'string',
            ],
            'connection_status' => [
                'required' => true,
                'type' => 'string',
            ],
            'speed_of_communication' => [
                'required' => true,
                'type' => 'string',
            ],
            'challenges' => [
                'type' => 'string',
            ],
            'treatment' => [
                'type' => 'string',
            ],
            'recommendations' => [
                'type' => 'string',
            ],
            'reviews' => [
                'type' => 'string',
            ],
        ])->setErrors([
            'date.required' => $lang('field_required'),
            'departure_city.required' => $lang('field_required'),
            'flight_number.required' => $lang('field_required'),
            'passengers.required' => $lang('field_required'),
            'departure_time.required' => $lang('field_required'),
            'arrival_city.required' => $lang('field_required'),
            'arrival_time.required' => $lang('field_required'),
            'working_counts.required' => $lang('field_required'),
            'non_working_counts.required' => $lang('field_required'),
            'average_pilgrim_waiting.required' => $lang('field_required'),
            'average_pilgrim_service.required' => $lang('field_required'),
            'average_pilgrim_service.pattern' => $lang('field_invalid'),
            'counters_working_start_time.required' => $lang('field_required'),
            'counters_working_end_time.required' => $lang('field_required'),
            'number_of_men.required' => $lang('field_required'),
            'number_of_women.required' => $lang('field_required'),
            'number_of_seats.required' => $lang('field_required'),
            'number_of_cases.required' => $lang('field_required'),
            'number_of_people_fingerprinted.required' => $lang('field_required'),
            'fingerprint_status.required' => $lang('field_required'),
            'fingerprint_status.required' => $lang('field_required'),
            'connection_status.required' => $lang('field_required'),
            'speed_of_communication.required' => $lang('field_required'),
        ]);

        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $data = [
                'date' => $formValidator->getValue('date') ,
                'departure_city' => $formValidator->getValue('departure_city') ,
                'flight_number' => $formValidator->getValue('flight_number') ,
                'passengers' => $formValidator->getValue('passengers') ,
                'departure_time' => $formValidator->getValue('departure_time') ,
                'arrival_city' => $formValidator->getValue('arrival_city') ,
                'arrival_time' => $formValidator->getValue('arrival_time') ,
                'working_counts' => $formValidator->getValue('working_counts') ,
                'non_working_counts' => $formValidator->getValue('non_working_counts') ,
                'average_pilgrim_waiting' => $formValidator->getValue('average_pilgrim_waiting'),
                'average_pilgrim_service' => $formValidator->getValue('average_pilgrim_service'),
                'counters_working_start_time' => $formValidator->getValue('counters_working_start_time') ,
                'counters_working_end_time' => $formValidator->getValue('counters_working_end_time') ,
                'number_of_men' => $formValidator->getValue('number_of_men') ,
                'number_of_women' => $formValidator->getValue('number_of_women') ,
                'number_of_seats' => $formValidator->getValue('number_of_seats') ,
                'number_of_cases' => $formValidator->getValue('number_of_cases') ,
                'number_of_people_fingerprinted' => $formValidator->getValue('number_of_people_fingerprinted') ,
                'number_of_bags' => $formValidator->getValue('number_of_bags') ,
                'fingerprint_status' => $formValidator->getValue('fingerprint_status') ,
                'fingerprint_status' => $formValidator->getValue('fingerprint_status') ,
                'connection_status' => $formValidator->getValue('connection_status') ,
                'speed_of_communication' => $formValidator->getValue('speed_of_communication') ,
                'challenges' => $formValidator->getValue('challenges') ,
                'treatment' => $formValidator->getValue('treatment') ,
                'recommendations' => $formValidator->getValue('recommendations') ,
                'reviews' => $formValidator->getValue('reviews') ,
            ];

            $json = json_encode($data);

            $counterDuration = strtotime($formValidator->getValue('counters_working_end_time')) - strtotime($formValidator->getValue('counters_working_start_time'));
            $counterDuration = $counterDuration < 0 ? 0 : $counterDuration;

            $bags = $formValidator->getValue('number_of_bags', 0);
            $bags = !empty($bags) ? $bags : 0;

            $departureFM = Model::get(DepartureForm::class);
            $departureFM->create([
                'flight_id' => $flightId,
                'json' => $json,
                'passengers' => $formValidator->getValue('passengers'),
                'working_counts' => $formValidator->getValue('working_counts'),
                'non_working_counts' => $formValidator->getValue('non_working_counts'),
                'number_of_men' => $formValidator->getValue('number_of_men'),
                'number_of_women' => $formValidator->getValue('number_of_women'),
                'number_of_seats' => $formValidator->getValue('number_of_seats'),
                'number_of_cases' => $formValidator->getValue('number_of_cases'),
                'number_of_bags' => $bags,
                'number_of_fingerprint' => $formValidator->getValue('number_of_people_fingerprinted'),
                'communication_speed' => $formValidator->getValue('speed_of_communication'),
                'connection_status' => $this->_getstatus($formValidator->getValue('connection_status')),
                'fingerprint_status' => $this->_getstatus($formValidator->getValue('fingerprint_status')),
                'average_pilgrim_service' => DateHelper::timeToSec($formValidator->getValue('average_pilgrim_service')),
                'counter_duration_in_sec' => $counterDuration,
                'created_at' => time()
            ]);

            Model::get(Flights::class)->update($flightId, [
                'status' => Flights::STATUS_ON_AIR,
                'dairport' => $formValidator->getValue('departure_airport')
            ]);

            throw new Redirect('departure-form-success');
        }

        $view = new View();
        $view->set("Form/departure", [
            'flightInfo' => $flightInfo,
            'cities' => $cities,
            'airports' => $airports
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function departureEdit( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $lang = Model::get(Language::class);

        $param = $request->param(0);

        $flightM = Model::get(Flights::class);

        $cityM = Model::get(City::class);
        $cities = $cityM->all();
        
        $flightM = Model::get(Flights::class);
        $flight = $flightM->getById( $param );
        $flight = FlightHelper::prepare([$flight]);
        $flightInfo = $flight[0];

        $departureAM = Model::get(DepartureForm::class);
        $departureInfo = $departureAM->getByFlightId( $param );

        if( !empty($departureInfo) )
        {
            $departureInfo['arr'] = json_decode($departureInfo['json'], true);
        }
        
        $flightInfo = Model::get(Flights::class)->getById($departureInfo['flight_id']);
        $flightInfo = FlightHelper::prepare([$flightInfo]);
        $flightInfo = $flightInfo[0];
        
        $destinationAirports = Model::get(Airport::class)->findAll(['city' => $departureInfo['arr']['arrival_city'], 'type' => Airport::TYPE_DESTINATION]);

        $formValidator = FormValidator::instance("edit-departure-form");
        $formValidator->setRules([
            'date' => [
                'required' => true,
                'type' => 'string',
            ],
            'departure_city' => [
                'required' => true,
                'type' => 'string',
            ],
            'departure_airport' => [
                'required' => true,
                'type' => 'select'
            ],
            'flight_number' => [
                'required' => true,
                'type' => 'string',
            ],
            'passengers' => [
                'required' => true,
                'type' => 'string',
            ],
            'departure_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'arrival_city' => [
                'required' => true,
                'type' => 'string',
            ],
            'arrival_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'working_counts' => [
                'required' => true,
                'type' => 'string',
            ],
            'non_working_counts' => [
                'required' => true,
                'type' => 'string',
            ],
            'average_pilgrim_waiting' => [
                'required' => true,
                'type' => 'string',
            ],
            'average_pilgrim_service' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^\d{2}:\d{2}:\d{2}$/'
            ],
            'counters_working_start_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'counters_working_end_time' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_men' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_women' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_seats' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_cases' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_people_fingerprinted' => [
                'required' => true,
                'type' => 'string',
            ],
            'number_of_bags' => [
                'type' => 'string',
            ],
            'fingerprint_status' => [
                'required' => true,
                'type' => 'string',
            ],
            'fingerprint_status' => [
                'required' => true,
                'type' => 'string',
            ],
            'connection_status' => [
                'required' => true,
                'type' => 'string',
            ],
            'speed_of_communication' => [
                'required' => true,
                'type' => 'string',
            ],
            'challenges' => [
                'type' => 'string',
            ],
            'treatment' => [
                'type' => 'string',
            ],
            'recommendations' => [
                'type' => 'string',
            ],
            'reviews' => [
                'type' => 'string',
            ],
        ])->setErrors([
            'date.required' => $lang('field_required'),
            'departure_city.required' => $lang('field_required'),
            'flight_number.required' => $lang('field_required'),
            'passengers.required' => $lang('field_required'),
            'departure_time.required' => $lang('field_required'),
            'arrival_city.required' => $lang('field_required'),
            'arrival_time.required' => $lang('field_required'),
            'working_counts.required' => $lang('field_required'),
            'non_working_counts.required' => $lang('field_required'),
            'average_pilgrim_waiting.required' => $lang('field_required'),
            'average_pilgrim_service.required' => $lang('field_required'),
            'average_pilgrim_service.pattern' => $lang('field_invalid'),
            'counters_working_start_time.required' => $lang('field_required'),
            'counters_working_end_time.required' => $lang('field_required'),
            'number_of_men.required' => $lang('field_required'),
            'number_of_women.required' => $lang('field_required'),
            'number_of_seats.required' => $lang('field_required'),
            'number_of_cases.required' => $lang('field_required'),
            'number_of_people_fingerprinted.required' => $lang('field_required'),
            'fingerprint_status.required' => $lang('field_required'),
            'fingerprint_status.required' => $lang('field_required'),
            'connection_status.required' => $lang('field_required'),
            'speed_of_communication.required' => $lang('field_required'),
        ]);

        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $data = [
                'date' => $formValidator->getValue('date') ,
                'departure_city' => $formValidator->getValue('departure_city') ,
                'flight_number' => $formValidator->getValue('flight_number') ,
                'passengers' => $formValidator->getValue('passengers') ,
                'departure_time' => $formValidator->getValue('departure_time') ,
                'arrival_city' => $formValidator->getValue('arrival_city') ,
                'arrival_time' => $formValidator->getValue('arrival_time') ,
                'working_counts' => $formValidator->getValue('working_counts') ,
                'non_working_counts' => $formValidator->getValue('non_working_counts') ,
                'average_pilgrim_waiting' => $formValidator->getValue('average_pilgrim_waiting'),
                'average_pilgrim_service' => $formValidator->getValue('average_pilgrim_service'),
                'counters_working_start_time' => $formValidator->getValue('counters_working_start_time') ,
                'counters_working_end_time' => $formValidator->getValue('counters_working_end_time') ,
                'number_of_men' => $formValidator->getValue('number_of_men') ,
                'number_of_women' => $formValidator->getValue('number_of_women') ,
                'number_of_seats' => $formValidator->getValue('number_of_seats') ,
                'number_of_cases' => $formValidator->getValue('number_of_cases') ,
                'number_of_people_fingerprinted' => $formValidator->getValue('number_of_people_fingerprinted') ,
                'number_of_bags' => $formValidator->getValue('number_of_bags') ,
                'fingerprint_status' => $formValidator->getValue('fingerprint_status') ,
                'fingerprint_status' => $formValidator->getValue('fingerprint_status') ,
                'connection_status' => $formValidator->getValue('connection_status') ,
                'speed_of_communication' => $formValidator->getValue('speed_of_communication') ,
                'challenges' => $formValidator->getValue('challenges') ,
                'treatment' => $formValidator->getValue('treatment') ,
                'recommendations' => $formValidator->getValue('recommendations') ,
                'reviews' => $formValidator->getValue('reviews') ,
            ];

            $json = json_encode($data);

            $counterDuration = strtotime($formValidator->getValue('counters_working_end_time')) - strtotime($formValidator->getValue('counters_working_start_time'));
            $counterDuration = $counterDuration < 0 ? 0 : $counterDuration;

            $bags = $formValidator->getValue('number_of_bags', 0);
            $bags = !empty($bags) ? $bags : 0;


            $departureFM = Model::get(DepartureForm::class);
            $departureFM->update($departureInfo['id'], [
                'flight_id' => $flightInfo['id'],
                'json' => $json,
                'passengers' => $formValidator->getValue('passengers'),
                'working_counts' => $formValidator->getValue('working_counts'),
                'non_working_counts' => $formValidator->getValue('non_working_counts'),
                'number_of_men' => $formValidator->getValue('number_of_men'),
                'number_of_women' => $formValidator->getValue('number_of_women'),
                'number_of_seats' => $formValidator->getValue('number_of_seats'),
                'number_of_cases' => $formValidator->getValue('number_of_cases'),
                'number_of_bags' => $bags,
                'number_of_fingerprint' => $formValidator->getValue('number_of_people_fingerprinted'),
                'communication_speed' => $this->_getstatus($formValidator->getValue('speed_of_communication')),
                'connection_status' => $this->_getstatus($formValidator->getValue('connection_status')),
                'fingerprint_status' => $this->_getstatus($formValidator->getValue('fingerprint_status')),
                'average_pilgrim_service' => DateHelper::timeToSec($formValidator->getValue('average_pilgrim_service')),
                'counter_duration_in_sec' => $counterDuration,
                'created_at' => time()
            ]);

            Model::get(Flights::class)->update($flightInfo['id'], [
                'status' => Flights::STATUS_ON_AIR,
                'dairport' => $formValidator->getValue('departure_airport')
            ]);

            throw new Redirect('flights/departure-form/' . $param);
        }

        $view = new View();
        $view->set('Form/edit_departure', [
            'flightInfo' => $flightInfo,
            'cities' => $cities,
            'departureInfo' => $departureInfo,
            'destinationAirports' => $destinationAirports

        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    private function _getpoint( $ans)
    {
        $point = 0;

        switch( $ans )
        {
            case 'راضي':
            case 'সন্তুষ্ট':
            case 'Satisfactory':
            case 'Puas':
            case 'Memuaskan':
            case 'مطمئن':
            case 'Yes':
            case 'Comfortable':
            case 'Quick':
            case 'Easy':
            case 'بہترین۔':
            case 'Saya tidak setuju':
            case 'saya setuju':
            case 'হ্যাঁ':
            case 'Ya':
                $point = 100;
                break;
            case 'نوعاً ما':
            case 'ভালো':
            case 'Unsatisfactory':
            case 'Biasa':
            case 'Tidak Memuaskan':
            case 'کچھ بھی نہیں':
            case 'Somewhat' : 
            case 'مناسب۔':
            case 'Tidak tahu':
            case 'Semacam':
            case 'কিছুটা':
            case 'Agak':
                $point = 50;
                break;

        }

        return $point;
    }

    private function _getstatus( $s )
    {
        $status = 0;

        switch( $s )
        {
            case 'excellent':
                $status = 2;
                break;
            case 'good':
                $status = 1;
                break;
            default:
                $status = 0;                
        }

        return $status;
    }

    private function _getPositive( $value )
    {
        $status = 0;
        switch( $value )
        {
            case 'no_delay':
            case 'yes':
                $status = 1;
                break;
            default:
                $status = 0;
        }

        return $status;
    }

}