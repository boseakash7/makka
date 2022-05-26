<?php

namespace Application\Controllers;

use Application\Helpers\FlightHelper;
use Application\Main\AuthController;
use Application\Models\Flights;
use System\Core\Controller;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Responses\View;

class Form extends Controller
{
    
    public function index( Request $request, Response $response )
    {
        
        $flightId = $request->param(0);
        $flightInfo = Model::get(Flights::class)->getById($flightId);
        $flightInfo = FlightHelper::prepare([$flightInfo]);
        $flightInfo = $flightInfo[0];

        $view = new View();
        $view->set("Form/departure", [
            'flightInfo' => $flightInfo
        ]);

        $response->set($view);
    }

}