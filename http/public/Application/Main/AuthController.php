<?php

namespace Application\Main;

use System\Core\Controller;
use System\Core\Exceptions\Redirect;

class AuthController extends Controller
{
    public function __construct($modelList)
    {
        parent::__construct($modelList);

        if ( !$this->user->isLoggedIn() ) throw new Redirect('');
    }
}