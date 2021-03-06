<?php

namespace Application\Controllers;

use Application\Main\AuthController;
use Application\Models\City;
use System\Core\Exceptions\Error404;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Responses\View;

class Dashboard extends AuthController
{
    
    public function index( Request $request, Response $response )
    {

        $param = $request->param(0, 'ms');

        $type = [ 'type' => City::TYPE_DESTINATION ];

        switch( $param )
        {
            case 'md':
            case 'md-2':
                $type = [ 'type' => City::TYPE_DESTINATION ];
                break;
            case 'ms':            
            case 'ms-2':
                $type = [ 'type' => City::TYPE_SOURCE ];
                break;
            default:
            throw new Error404;
        }

        $cityId = $request->get('city');
        $from = $request->get('from');
        $to = $request->get('to');

        /**
         * @var City
         */
        $cM = Model::get(City::class);
        $cities = $cM->findAll($type);

        $view = new View();
        $view->set('Dashboard/index', [
            'from' => $from,
            'to' => $to,
            'cityId' => $cityId,
            'cities' => $cities,
            'page' => $param
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

}