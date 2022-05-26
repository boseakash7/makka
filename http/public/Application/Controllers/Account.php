<?php

namespace Application\Controllers;

use Application\Helpers\AirportHelper;
use Application\Main\AuthController;
use Application\Models\Airport;
use Application\Models\City;
use System\Core\Controller;
use System\Core\Exceptions\Error404;
use System\Core\Exceptions\Redirect;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Libs\FormValidator;
use System\Models\Cookie;
use System\Models\Language;
use System\Responses\View;

class Account extends AuthController
{
    public function changePassword( Request $request, Response $response )
    {
        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("password");
        $formValidator->setRules([
            'password1' => [
                'required' => true,
                'type' => 'string',
            ],
            'password2' => [
                'required' => true,
                'type' => 'string',
            ]
        ])->setErrors([
            'password1.required' => $lang('field_required'),            
            'password2.required' => $lang('field_required'),
        ]);

        $isSuccess = false;
        if ( $request->getHTTPMethod() == "POST" && $formValidator->validate() )
        {
            $pass1 = $formValidator->getValue('password1');
            $pass2 = $formValidator->getValue('password2');

            if ( $pass1 == $pass2 )
            {
                $userInfo = $this->user->getInfo();
                $this->user->update($userInfo['id'], [
                    'password' => password_hash($pass1, PASSWORD_DEFAULT),
                    'reset_token' => null
                ]);

                $isSuccess = true;

                throw new Redirect('account/change-password');
            } else {
                $formValidator->setError('password1', $lang('password_does_not_match'));
                $formValidator->setError('password2', $lang('password_does_not_match'));
            }
        }

        $view = new View();
        $view->set('Account/change_password', [
            'isSuccess' => $isSuccess
        ]);
        $view->prepend('header');
        $view->append('footer');

        $response->set($view);
    }

    public function lang( Request $request, Response $response )
    {
        $code = $request->get('code');
        $url = $request->get('url');

        switch( $code )
        {
            case 'en':
            case 'ar':
                break;
            default:
                throw new Redirect('/');
        }
        /**
         * @var Cookie
         */
        $cookie = Model::get(Cookie::class);
        $cookie->setCookie('lang', $code, time() + 890999, '/');

        throw new Redirect($url);
    }

}