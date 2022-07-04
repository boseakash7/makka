<?php 

namespace Application\Controllers;

use Application\Helpers\AssessmentHelper;
use Application\Helpers\FlightHelper;
use Application\Main\AuthController;
use Application\Models\ArrivalAssesment;
use Application\Models\ArrivalForm;
use Application\Models\City;
use Application\Models\DepartureAssesment;
use Application\Models\DepartureForm;
use Application\Models\Flights;
use Application\Models\Passenger;
use System\Core\Controller;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Models\Language;
use System\Responses\File;

class Exports extends AuthController
{
    public function flights( Request $request, Response $response )
    {
        $userInfo = $this->user->getInfo();

        $flightM = Model::get(Flights::class);
        $flights = $flightM->all();
        $flights = FlightHelper::prepare($flights);

        /**
         * @var \System\Models\Language
         */
        $lang = Model::get(Language::class);
       
        $response->setHeaders([
            'Content-Type: text/csv; charset=utf-8',
            'content-Disposition: attachment; filename=flights.xls'
        ]);

        $data = [];

        $data[] = array(
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
            $lang('first_check_in'),
            $lang('last_check_out'),
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
            $lang('number_of_passengers'),
            $lang('take_off_place'),
            $lang('expected_arrival_time'),
            $lang('average_waiting_time_unitil_access'),
            $lang('average_waiting_time_unitil_end_of_inspection'),
            $lang('average_waiting_until_sorting_system'),
            $lang('how_long_does_luggage_arrive_at'),
            $lang('first_hajji_arrived_time'),
            $lang('last_hajji_arrived_time'),
            $lang('first_bus_leave_time'),
            $lang('last_bus_leave_time'),
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
        );

        $departureAM = Model::get(DepartureForm::class);

        foreach ($flights as $flight) 
        {
            $departureInfo = $departureAM->getByFlightId( $flight['id'] );

            if( !empty($departureInfo) )
            {   
                $departureInfo['arr'] = json_decode($departureInfo['json'], true);

                $departureCityInfo = Model::get(City::class)->find(['id' => $departureInfo['arr']['departure_city']]);
                $arrivalCityInfo = Model::get(City::class)->find(['id' => $departureInfo['arr']['arrival_city']]);
            }

            $arrivalAM = Model::get(ArrivalForm::class);
            $arrivalInfo = $arrivalAM->getByFlightId( $flight['id'] );

            if( !empty($arrivalInfo) )
            {
                $arrivalInfo['arr'] = json_decode($arrivalInfo['json'], true);

                $arrivalFlightInfo = Model::get(City::class)->find(['id' => $arrivalInfo['arr']['arrival_city']]);
                $takeOffPlace = Model::get(City::class)->find(['id' => $arrivalInfo['arr']['take_off_place']]);
            }
            
            $firstCheckInTime = Model::get(Passenger::class)->firstCheckInTime($flight['id']);
            $firstCheckInTime = $firstCheckInTime ? date('Y-m-d H:i:s', $firstCheckInTime) : '-';

            $lastCheckOutTime = Model::get(Passenger::class)->lastCheckOutTime($flight['id']);
            $lastCheckOutTime = $lastCheckOutTime ? date('Y-m-d H:i:s', $lastCheckOutTime) : '-';
            
            $data []= array(
                $flight['id'],
                $flight['number'],
                $flight['airline']['en_name'] . '/' . $flight['airline']['ar_name'],
                $flight['tdate'],
                $flight['ttime'],
                $flight['saudi_date'],
                $flight['saudi_time'],
                $flight['passengers'],
                $lang($flight['status']),
                isset($flight['sairport']['en_name']) ? $flight['sairport']['en_name']  . '/' . $flight['sairport']['ar_name'] : '-',
                isset($flight['dairport']['en_name']) ? $flight['dairport']['en_name']  . '/' . $flight['dairport']['ar_name'] : '-',
                isset($departureInfo['arr']['date']) ? $departureInfo['arr']['date'] : '-',
                isset($departureInfo['arr']['departure_time']) ? date('Y-m-d H:i',  strtotime($departureInfo['arr']['departure_time'])) : '-',
                isset($departureCityInfo['en_name']) ? $departureCityInfo['en_name'] .'/' . $departureCityInfo['ar_name'] : '-',
                isset($departureInfo['arr']['passengers']) ? $departureInfo['arr']['passengers'] : '-',
                $firstCheckInTime,
                $lastCheckOutTime,
                isset($arrivalCityInfo['en_name']) ? $arrivalCityInfo['en_name'] . '/' . $arrivalCityInfo['ar_name'] : '-',
                isset($departureInfo['arr']['arrival_time']) ?  date('Y-m-d H:i', strtotime($departureInfo['arr']['arrival_time'])) : '-',
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
                isset($departureInfo['arr']['fingerprint_status']) ? $lang($departureInfo['arr']['fingerprint_status']) : '-',    
                isset($departureInfo['arr']['connection_status']) ? $lang($departureInfo['arr']['connection_status']) : '-', 
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
                isset($arrivalInfo['arr']['passengers']) ? $arrivalInfo['arr']['passengers'] : '-',
                isset($takeOffPlace[$lang->current() . '_name']) ? $takeOffPlace['en_name']  .'/' . $takeOffPlace['ar_name'] : '-',
                isset($arrivalInfo['arr']['expected_arrival_time']) ? $arrivalInfo['arr']['expected_arrival_time'] : '-',
                isset($arrivalInfo['arr']['average_waiting_time_unitil_access']) ? $arrivalInfo['arr']['average_waiting_time_unitil_access'] : '-',
                isset($arrivalInfo['arr']['average_waiting_time_unitil_end_of_inspection']) ? $arrivalInfo['arr']['average_waiting_time_unitil_end_of_inspection'] : '-',
                isset($arrivalInfo['arr']['average_waiting_until_sorting_system']) ? $arrivalInfo['arr']['average_waiting_until_sorting_system'] : '-',
                isset($arrivalInfo['arr']['how_long_does_luggage_arrive_at']) ? $arrivalInfo['arr']['how_long_does_luggage_arrive_at'] : '-',
                isset($arrivalInfo['arr']['first_hajji_arrived_time']) ? $arrivalInfo['arr']['first_hajji_arrived_time'] : '-',
                isset($arrivalInfo['arr']['last_hajji_arrived_time']) ? $arrivalInfo['arr']['last_hajji_arrived_time'] : '-',
                isset($arrivalInfo['arr']['first_bus_leave_time']) ? $arrivalInfo['arr']['first_bus_leave_time'] : '-',
                isset($arrivalInfo['arr']['last_bus_leave_time']) ? $arrivalInfo['arr']['last_bus_leave_time'] : '-',
                isset($arrivalInfo['arr']['flight_delay']) ? $lang($arrivalInfo['arr']['flight_delay']) : '-',
                isset($arrivalInfo['arr']['number_of_buses_operated_to_transport_pilgrims']) ? $arrivalInfo['arr']['number_of_buses_operated_to_transport_pilgrims'] : '-',
                isset($arrivalInfo['arr']['number_of_buses_operating_with_mecca_logo']) ? $arrivalInfo['arr']['number_of_buses_operating_with_mecca_logo'] : '-',
                isset($arrivalInfo['arr']['are_there_unmarked_buses']) ? $lang($arrivalInfo['arr']['are_there_unmarked_buses']) : '-',
                isset($arrivalInfo['arr']['are_there_any_accidents']) ? $lang($arrivalInfo['arr']['are_there_any_accidents']) : '-',
                isset($arrivalInfo['arr']['number_of_cases']) ? $arrivalInfo['arr']['number_of_cases'] : '-',
                isset($arrivalInfo['arr']['challenges']) ? $arrivalInfo['arr']['challenges'] : '-',
                isset($arrivalInfo['arr']['solutions']) ? $arrivalInfo['arr']['solutions'] : '-',
                isset($arrivalInfo['arr']['recommendations']) ? $arrivalInfo['arr']['recommendations'] : '-',
                isset($arrivalInfo['arr']['reviews']) ? $arrivalInfo['arr']['reviews'] : '-',

                

            );
        }
        
        
        $file = new File('text/csv');
        $file->set($this->_buildTable($data));
        $response->set($file);
    }

    public function arrivalAssessments( Request $request, Response $response )
    {

        $lang = Model::get(Language::class);

        /**
         * @var ArrivalAssesment
         */
        $aAssM = Model::get(ArrivalAssesment::class);
        $ass = $aAssM->all();

        /**
         * @var Flights
         */
        $flightM = Model::get(Flights::class);
        $flights = $flightM->getByIds(array_map(function($item) {  return $item['flight_id']; }, $ass));
        $flights = FlightHelper::prepare($flights);     
        
        /**
         * @var ArrivalForm
         */
        $arriFM = Model::get(ArrivalForm::class);        


        $data = [];
        $data[] = [
            $lang('flight_number'),
            $lang('date'),
            $lang('source'),
            $lang('destination'),
            $lang('q1'),
            $lang('q2'),
            $lang('q3')
        ];        
        
        foreach ( $ass as $row )
        {
            $json = json_decode($row['json'], true);

            $date = $arriFM->getByFlightId($row['flight_id']);

            if ( $date )            
            {
                $date = json_decode($date['json'], true);
                $date = $date['date'];
            } else {
                $date = '-';
            }

            $data[] = [
                isset($flights[$row['flight_id']]) ? $flights[$row['flight_id']]['number'] : '-',
                $date,
                isset($flights[$row['flight_id']]) ? $flights[$row['flight_id']]['sairport'][$lang->current() . '_name'] : '-',
                isset($flights[$row['flight_id']]) && isset($flights[$row['flight_id']]['dairport']) ? $flights[$row['flight_id']]['dairport'][$lang->current() . '_name'] : '-',
                $this->_getAssessmentValue($json['employment_interaction']),
                $this->_getAssessmentValue($json['clarity_procedure']),
                $this->_getAssessmentValue($json['service_provided'])
            ]; 
        }

        $file = new File('text/csv');
        $file->set($this->_buildTable($data));

        $response->setHeaders([
            'Content-Type: text/csv; charset=utf-8',
            'content-Disposition: attachment; filename=arrival-assessments.xls'
        ]);
        $response->set($file);
    }

    public function departureAssessments( Request $request, Response $response )
    {
        $response->setHeaders([
            'Content-Type: text/csv; charset=utf-8',
            'content-Disposition: attachment; filename=departure-assessments.xls'
        ]);

        $lang = Model::get(Language::class);

        /**
         * @var DepartureAssesment
         */
        $aAssM = Model::get(DepartureAssesment::class);
        $ass = $aAssM->all();

        /**
         * @var Flights
         */
        $flightM = Model::get(Flights::class);
        $flights = $flightM->getByIds(array_map(function($item) {  return $item['flight_id']; }, $ass));
        $flights = FlightHelper::prepare($flights);

        /**
         * @var ArrivalForm
         */
        $destFM = Model::get(ArrivalForm::class);        

        $data[] = [];
        $data[] = [
            $lang('flight_number'),
            $lang('q1'),
            $lang('q2'),
            $lang('q3'),
            $lang('q4'),
            $lang('q5')
        ];
        
        foreach ( $ass as $row )
        {
            $json = json_decode($row['json'], true);
            
            $date = $destFM->getByFlightId($row['flight_id']);

            if ( $date )            
            {
                $date = json_decode($date['json'], true);
                $date = $date['date'];
            } else {
                $date = '-';
            }

            $data[] = [
                isset($flights[$row['flight_id']]) ? $flights[$row['flight_id']]['number'] : '-',
                $date,
                isset($flights[$row['flight_id']]) ? $flights[$row['flight_id']]['sairport'][$lang->current() . '_name'] : '-',
                isset($flights[$row['flight_id']]) && isset($flights[$row['flight_id']]['dairport']) ? $flights[$row['flight_id']]['dairport'][$lang->current() . '_name'] : '-',
                $this->_getAssessmentValue($json['employment_interaction']),
                $this->_getAssessmentValue($json['clarity_procedure']),
                $this->_getAssessmentValue($json['service_provided']),
                $this->_getAssessmentValue($json['awareness']),
                $this->_getAssessmentValue($json['makkah_hall'])
            ]; 
        }

        $file = new File('text/csv');
        $file->set($this->_buildTable($data));
        $response->set($file);
    }


    private function _getAssessmentValue( $value )
    {
        $output = 3;
        switch( strtolower($value) )
        {
            case 'yes':
                $output = 1;
                break;
            case 'somewhat':
                $output = 2;
                break;
        }

        return $output;
    }

    private function _buildTable( $data )
    {
        
        $html = "<table>";
        foreach( $data as $row )
        {
            $html .= '<tr>';
            $html .= implode('', array_map(function($item) { return '<td>' . $item . '</td>';  }, $row));
            $html .= "</tr>";
        }
        $html .= "</table>";

        return $html;
    }
}