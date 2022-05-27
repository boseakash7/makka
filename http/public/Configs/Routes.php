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
        '/arrivals' => "Flights::arrival",
        '/completed' => "Flights::completed",
        '/flights/add' => "Flights::add",
        '/flights/edit/(:num)' => "Flights::edit",
        '/flights/open/(:num)' => "Flights::open",
        '/flights/scan/(:num)' => "Flights::scan",
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

        // forms
        '/form/departure/(:num)' => 'Form::departure',
        '/form/arrival/(:num)' => 'Form::arrival',
        '/departure-form-success' => 'Form::departureSuccess',
        '/departure-form-success' => 'Form::departureSuccess',
        '/form/departure-assesment/(:num)' => 'Form::departureAssesment',
        '/form/arrival-assesment/(:num)' => 'Form::arrivalAssesment',
        '/arrival-assesment-form-success' => 'Form::arrivalAssesmentSuccess',
        '/departure-assesment-form-success' => 'Form::departureAssesmentSuccess',

        '/ajax/flight/passenger-check' => "Ajax\Flight::check",
        '/ajax/flight/passenger-add' => "Ajax\Flight::add",
        
    ],

));
