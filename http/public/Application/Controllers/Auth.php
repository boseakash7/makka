<?php

namespace Application\Controllers;

use Application\Models\User;
use System\Core\Controller;
use System\Core\Exceptions\Error404;
use System\Core\Exceptions\Redirect;
use System\Core\Model;
use System\Core\Request;
use System\core\Response;
use System\Helpers\URL;
use System\Libs\FormValidator;
use System\Models\Email;
use System\Models\Language;
use System\Responses\View;

class Auth extends Controller
{
    public function login( Request $request, Response $response )
    {
        if ( $this->user->isLoggedIn() ) $this->_handleLoginSuccess();

        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("login");
        $formValidator->setRules([
            'email' => [
                'required' => true,
                'type' => 'string',
            ],
            'password' => [
                'required' => true,
                'type' => 'string',
            ]
        ]);

        if ( $request->getHTTPMethod() == 'POST' && $formValidator->validate() )
        {
            /**
             * @var User
             */
            $userM = Model::get(User::class);

            // First find the user
            // then check if the user password is empty
            $user = $userM->find([ 'email' => $formValidator->getValue('email') ]);
            if ( !empty( $user ) && $user['password'] == null )
            {
                $userM->update($user['id'], [
                    'password' => password_hash($formValidator->getValue('password'), PASSWORD_DEFAULT)
                ]);
            }

            $result = $userM->login([
                'username' => $formValidator->getValue('email'),
                'password' => $formValidator->getValue('password')
            ]);


            switch( $result )
            {
                case User::INVALID_USERNAME:
                case User::INVALID_PASSWORD:
                    $formValidator->setError('email', $lang("email_password_combination_wrong"));
                    $formValidator->setError('password', $lang("email_password_combination_wrong"));
                    break;
                default:
                    $this->_handleLoginSuccess();
            }
        }

        $view = new View();
        $view->set('Outer/Auth/login');
        $view->prepend('Outer/header');
        $view->append('Outer/footer');

        $response->set($view);
    }

    public function reset( Request $request, Response $response )
    {
        $lang = Model::get(Language::class);

        $formValidator = FormValidator::instance("reset");
        $formValidator->setRules([
            'email' => [
                'required' => true,
                'type' => 'string',
                'pattern' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'
            ]
        ])->setErrors([
            'email.required' => $lang('field_required'),            
            'email.pattern' => $lang('field_not_email'),
        ]);

        $isSuccess = false;
        if ( $request->getHTTPMethod() == "POST" && $formValidator->validate() )
        {
            // Now check if the user with this email is found.
            $email = $formValidator->getValue('email');
            $user = $this->user->find([ 'email' => $email ]);
            if ( !empty($user) )
            {
                $token = rand(100000000, 999999999);

                $this->user->update($user['id'], [ 'reset_token' => $token ]);

                $isSuccess = true;

                // /**
                //  * @var Email
                //  */
                // $email = Model::get(Email::class);
                // $mail = $email->new();

                // $mail->to($email);
                // $mail->subject($lang("reset_password_email_subject"));
                // $mail->body('Emails/reset_password', [
                //     'link' => URL::full('/reset-password/create/' . $token)
                // ]);
                // $mail->send();
            }else {
                $formValidator->setError('email', $lang("email_not_found"));
            }
        }

        $view = new View();
        $view->set('Outer/Auth/reset', [
            'isSuccess' => $isSuccess
        ]);
        $view->prepend('Outer/header');
        $view->append('Outer/footer');

        $response->set($view);
    }

    public function createPassword( Request $request, Response $response )
    {
        $lang = Model::get(Language::class);

        $token = $request->param(0);
        $user = $this->user->find([ 'reset_token' => $token ]);
        if ( empty($user) ) throw new Error404();

        $formValidator = FormValidator::instance("create");
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
                $this->user->update($user['id'], [
                    'password' => password_hash($pass1, PASSWORD_DEFAULT),
                    'reset_token' => null
                ]);

                $isSuccess = true;
            } else {
                $formValidator->setError('password1', $lang('password_does_not_match'));
                $formValidator->setError('password2', $lang('password_does_not_match'));
            }
        }

        $view = new View();
        $view->set('Outer/Auth/create_password', [
            'isSuccess' => $isSuccess
        ]);
        $view->prepend('Outer/header');
        $view->append('Outer/footer');

        $response->set($view);
    }

    public function logout()
    {
        $this->user->logout();
        throw new Redirect('');
    }

    private function _handleLoginSuccess()
    {
        $userInfo = $this->user->getInfo();
        
        switch ($userInfo['type']) {
            case User::TYPE_ADM:
                throw new Redirect('airports');
                break;
            case User::TYPE_SUP:
                if ( $this->user->fromSource() ) throw new Redirect('flights');
                else throw new Redirect('arrivals');
                break;
            case User::TYPE_EMP:                
                if ( $this->user->fromSource() ) throw new Redirect('flights');
                else throw new Redirect('arrivals');
                break;
        }
    }
}