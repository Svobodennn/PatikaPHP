<?php

namespace App\Cms\Middlewares;

use Core\Cms\BaseMiddleware;
use Core\Cms\Session;

class AuthMiddleware extends BaseMiddleware
{
    public function isLogin(){
        $login = Session::getSession('login');

        if (!$login){

            session_destroy();
            redirect('login');
        }
    }
}