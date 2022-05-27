<?php

namespace Application\Controllers;

use Application\Helpers\AirportHelper;
use Application\Helpers\UserHelper;
use Application\Main\AuthController;
use Application\Models\User;
use Application\Models\Airport;
use Application\Models\City;
use Application\Models\Employee as ModelsEmployee;
use System\Core\Controller;
use System\Core\Exceptions\Redirect;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Libs\FormValidator;
use System\Models\Language;
use System\Responses\View;

class Employee extends AuthController
{
    public function index( Request $request, Response $response )
    {
        $userM = Model::get(User::class);
        $users = $userM->findAll([ 'type' => User::TYPE_EMP ]);
        $users = UserHelper::prepare($users);

        $view = new View();
        $view->set('Employee/index', [
            'users' => $users
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }


    public function add( Request $request, Response $response )
    {
        $airportId = $request->param(0);

        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("employee");
        $formValidator->setRules([
            'name' => [
                'required' => true,
                'type' => 'string'
            ],
            'email' => [
                'required' => true,
                'type' => 'string',
                'unique' => 'users,email',
                'pattern' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'
            ],           
            'airport' => [
                'required' => true,
                'type' => 'select'
            ], 
        ])->setErrors([
            'name.required' => $lang('field_required'),            
            'email.required' => $lang('field_required'),
            'email.unique' => $lang('field_unique'),
            'email.pattern' => $lang('field_not_email'),
            'airport.required' => $lang('field_required')
        ]);

        /**
         * @var Airport
         */
        $airportM = Model::get(Airport::class);
        $airports = $airportM->all();

        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $userM = Model::get(User::class);
            $result = $userM->create([
                'name' => $formValidator->getValue('name'),
                'email' => $formValidator->getValue('email'),
                'reset_token' => null,
                'password' => null,
                'type' => User::TYPE_EMP,
                'airport' => $formValidator->getValue('airport'),
                'created_at' => time()
            ]);

            if ( $result ) throw new Redirect('employee');
        }

        $view = new View();
        $view->set('Employee/add', [
            'airports' => $airports,
            'airportId' => $airportId
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function edit( Request $request, Response $response )
    {
        $param = $request->param(0);
        
        /**
         * @var User
        */
        $userM = Model::get(User::class);
        $user = $userM->find( [ 'id' => $param ] );

        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("employee");
        $formValidator->setRules([
            'name' => [
                'required' => true,
                'type' => 'string'
            ],
            'email' => [
                'required' => true,
                'type' => 'string',
                'unique' => 'users,email,'. $user['email'],
                'pattern' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'
            ],           
            'airport' => [
                'required' => true,
                'type' => 'select'
            ],          
            'password' => [                
                'type' => 'string'
            ]
        ])->setErrors([
            'name.required' => $lang('field_required'),            
            'email.required' => $lang('field_required'),
            'email.unique' => $lang('field_unique'),
            'email.pattern' => $lang('field_not_email'),
            'airport.required' => $lang('field_required')
        ]);

        /**
         * @var City
         */
        $cM = Model::get(City::class);
        $cities = $cM->all();

        /**
         * @var Airport
         */
        $airportM = Model::get(Airport::class);
        $airports = $airportM->all();
        
        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            $arr = [
                'name' => $formValidator->getValue('name'),
                'email' => $formValidator->getValue('email'),
                'airport' => $formValidator->getValue('airport')
            ];
            $password = $formValidator->getValue('password');
            if ( !empty($password) )
            {
                $arr['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            $result = $userM->update($param, $arr);

            if ( $result ) throw new Redirect('employee');
        }

        $view = new View();
        $view->set('Employee/edit', [
            'user' => $user,
            'airports' => $airports
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }
}