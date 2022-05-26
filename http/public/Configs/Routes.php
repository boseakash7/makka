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
        '/employee/edit/(:num)' => "Employee::edit",

        '/supervisor' => "Supervisor::index",
        '/supervisor/add' => "Supervisor::add",
        '/supervisor/edit/(:num)' => "Supervisor::edit",

        '/flights' => "Flights::index",
        '/flights/add' => "Flights::add",
        '/flights/edit/(:num)' => "Flights::edit",
        '/flights/open/(:num)' => "Flights::open",
        '/flights/scan/(:num)' => "Flights::scan",
        '/flights/check-in/(:num)' => "Flights::checkIn",
        '/flights/check-out/(:num)' => "Flights::checkOut",

        '/account/change-password' => 'Account::changePassword',
        '/account/lang' => 'Account::lang',
        
        
    ],

));
