<?php

namespace Application\Controllers;

use Application\Helpers\AirportHelper;
use Application\Main\AuthController;
use Application\Models\Airport;
use Application\Models\City;
use System\Core\Controller;
use System\Core\Exceptions\Redirect;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Libs\FormValidator;
use System\Models\Language;
use System\Responses\View;

class Airports extends AuthController
{
    public function index( Request $request, Response $response )
    {
        $aM = Model::get(Airport::class);
        $airports = $aM->all();
        $airports = AirportHelper::prepare($airports);

        $view = new View();
        $view->set('Airports/index', [
            'airports' => $airports
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }


    public function add( Request $request, Response $response )
    {

        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("airport");
        $formValidator->setRules([
            'en_name' => [
                'required' => true,
                'type' => 'string'
            ],
            'ar_name' => [
                'required' => true,
                'type' => 'string'
            ],
            'city' => [
                'required' => true,
                'type' => 'select'
            ],
            'type' => [
                'required' => true,
                'type' => 'select'
            ]
        ])->setErrors([
            'en_name.required' => $lang('field_required'),
            'ar_name.required' => $lang('field_required'),
            'city.required' => $lang('field_required'),
            'type.required' => $lang('field_required')
        ]);

        /**
         * @var City
         */
        $cM = Model::get(City::class);
        $cities = $cM->all();
        
        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $airM = Model::get(Airport::class);
            $result = $airM->create([
                'en_name' => $formValidator->getValue('en_name'),
                'ar_name' => $formValidator->getValue('ar_name'),
                'city' => $formValidator->getValue('city'),
                'type' => $formValidator->getValue('type'),
                'created_at' => time()
            ]);

            if ( $result ) throw new Redirect('airports');
        }

        $view = new View();
        $view->set('Airports/add', [
            'cities' => $cities
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function edit( Request $request, Response $response )
    {
        $param = $request->param(0);
        
        /**
         * @var Airport
         */
        $airM = Model::get(Airport::class);
        $airport = $airM->getById( $param );
        

        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("airport");
        $formValidator->setRules([
            'en_name' => [
                'required' => true,
                'type' => 'string'
            ],
            'ar_name' => [
                'required' => true,
                'type' => 'string'
            ],
            'city' => [
                'required' => true,
                'type' => 'select'
            ],
            'type' => [
                'required' => true,
                'type' => 'select'
            ]
        ])->setErrors([
            'en_name.required' => $lang('field_required'),
            'ar_name.required' => $lang('field_required'),
            'city.required' => $lang('field_required'),
            'type.required' => $lang('field_required')
        ]);

        /**
         * @var City
         */
        $cM = Model::get(City::class);
        $cities = $cM->all();
        
        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $result = $airM->update($param, [
                'en_name' => $formValidator->getValue('en_name'),
                'ar_name' => $formValidator->getValue('ar_name'),
                'city' => $formValidator->getValue('city'),
                'type' => $formValidator->getValue('type')
            ]);

            if ( $result ) throw new Redirect('airports');
        }

        $view = new View();
        $view->set('Airports/edit', [
            'cities' => $cities,
            'airport' => $airport
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }
}