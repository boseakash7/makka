<?php

namespace Application\Controllers;

use Application\Main\AuthController;
use System\Core\Request;
use System\core\Response;
use System\Responses\View;

class Dashboard extends AuthController
{
    
    public function index( Request $request, Response $response )
    {
        $view = new View();
        $view->set('Dashboard/index');
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

}