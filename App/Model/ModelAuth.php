<?php

namespace App\Cms\Model;

use Core\Cms\BaseModel;
use Core\Cms\Session;

class ModelAuth extends BaseModel
{
    public function userLogin($data)
    {

         extract($data);
        $password = md5($password);
        $user = $this->db->query("select * from system_users where system_users.email = '$email' && system_users.password = '$password'");
        if ($user) {

            Session::setSession('login', true);
            Session::setSession('name', $user['name']);
            Session::setSession('surname', $user['surname']);
            Session::setSession('email', $user['email']);
            Session::setSession('password', $user['password']);
            Session::setSession('id', $user['id']);
            return true;
        } else {
            return false;
        }

    }
}