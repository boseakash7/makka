<?php

namespace Application\Controllers;

use Application\Main\AuthController;
use Application\Models\Employee;
use Application\Models\Flights;
use System\Core\Controller;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Responses\View;

class Scanner extends Controller
{
    
    public function index( Request $request, Response $response )
    {
        $flightId = $request->param(0);
        $empId = $request->param(1);

        $flightM = Model::get(Flights::class);
        $flightInfo = $flightM->getById( $flightId );

        $empM = Model::get(Employee::class);
        $empInfo = $empM->getById( $empId );

        $uParser = new \WhichBrowser\Parser($_SERVER['HTTP_USER_AGENT']);
        $device = $uParser->os->getName();

        $safari = true;
        if( $device == 'iOS' )
        {
            if( $uParser->browser->getName() != 'Safari' )
            {
                $safari = false;
            }
        }

        $view = new View();
        $view->set('Flights/index', [
            'flightInfo' => $flightInfo,
            'empInfo' => $empInfo
        ]);

        $response->set($view);
    }

}