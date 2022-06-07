<?php

use System\Core\Config;

$routes = Config::get('Routes');
$routes->set(array(

    'makka' => [        
        // Routes will be here
        '/' => "Auth::login",
        '/logout' => "Auth::logout",

        '/reset-password' => "Auth::reset",
        '/reset-password/create/(:string)' => "Auth::createPassword",

        '/dashboard' => "Dashboard::index",
        '/dashboard/(:string)' => "Dashboard::index",

        '/airports' => "Airports::index",
        '/airports/add' => "Airports::add",
        '/airports/edit/(:num)' => "Airports::edit",

        '/employee' => "Employee::index",
        '/employee/add' => "Employee::add",
        '/employee/add/(:num)' => "Employee::add",
        '/employee/edit/(:num)' => "Employee::edit",

        '/supervisor' => "Supervisor::index",
        '/supervisor/add' => "Supervisor::add",
        '/supervisor/add/(:num)' => "Supervisor::add",
        '/supervisor/edit/(:num)' => "Supervisor::edit",

        '/flights' => "Flights::index",
        '/all-f' => "Flights::all",
        '/arrivals' => "Flights::arrival",
        '/completed' => "Flights::completed",
        '/flights/add' => "Flights::add",
        '/flights/edit/(:num)' => "Flights::edit",
        '/flights/open/(:num)' => "Flights::open",
        '/flights/scan/(:num)/(:string)' => "Flights::scan",        
        '/flights/arrived/(:num)' => "Flights::arrived",
        '/flights/check-in/(:num)' => "Flights::checkIn",
        '/flights/check-out/(:num)' => "Flights::checkOut",
        '/flights/close/(:num)' => "Flights::close",
        '/flights/log/(:num)' => "Flights::log",
        '/flights/summary/(:num)' => "Flights::summary",
        '/flights/arrival-assessment/(:num)' => "Flights::arrivalAssessment",
        '/flights/departure-assessment/(:num)' => "Flights::departureAssessment",
        '/flights/departure-form/(:num)' => "Flights::departureForm",
        '/flights/arrival-form/(:num)' => "Flights::arrivalForm",        

        '/account/change-password' => 'Account::changePassword',
        '/account/lang' => 'Account::lang',

        '/mode' => "Mode::index",

        // Export
        '/flights/export' => "Flights::export",

        // forms
        '/form/departure/(:num)' => 'Form::departure',
        '/form/arrival/(:num)' => 'Form::arrival',
        '/form/departure/edit/(:num)' => 'Form::departureEdit',
        '/form/arrival/edit/(:num)' => 'Form::arrivalEdit',
        '/departure-form-success' => 'Form::departureSuccess',
        '/arrival-form-success' => 'Form::arrivalSuccess',
        '/form/departure-assessment/(:num)' => 'Form::departureAssesment',
        '/form/arrival-assessment/(:num)' => 'Form::arrivalAssesment',
        '/arrival-assesment-form-success' => 'Form::arrivalAssesmentSuccess',
        '/departure-assesment-form-success' => 'Form::departureAssesmentSuccess',
        '/arrival-assesment-form-success/(:num)' => 'Form::arrivalAssesmentSuccess',
        '/departure-assesment-form-success/(:num)' => 'Form::departureAssesmentSuccess',

        '/ajax/flight/passenger-check' => "Ajax\Flight::check",
        '/ajax/flight/passenger-add' => "Ajax\Flight::add",
        '/ajax/flight/can-scan' => "Ajax\Flight::canScan",
        '/ajax/form/get-airports-by-city' => "Ajax\Form::getAirportsByCity"
        
    ],

));
