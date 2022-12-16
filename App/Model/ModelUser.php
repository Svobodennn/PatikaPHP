<?php

namespace App\Cms\Model;

use Core\Cms\BaseModel;
use Core\Cms\Session;

class ModelUser extends BaseModel
{
    public function editProfile($data)
    {

        extract($data);
        $id = Session::getSession('id');


        $user = $this->db->connect->prepare('update system_users set 
                          system_users.name=?,
                          system_users.surname=?,
                          system_users.email=?
                           where system_users.id=?
                          ');
        $update = $user->execute([
            $name,
            $surname,
            $email,
            $id

        ]);

            if($update){
                return true;
            } else {
                return false;
            }
    }

    public function getProfile(){
        $id = Session::setSession('id');
       return  $this->db->query("Select *  from system_users where system_users.id='$id'");
    }
    public function changePassword($data){
        extract($data);
        $id = Session::getSession('id');

        $user = $this->db->connect->prepare('update system_users set 
                          system_users.password=?
                           where system_users.id=?
                          ');
        $update = $user->execute([
            md5($new_password),
            $id
        ]);

        if($update){
            return true;
        } else {
            return false;
        }


    }
}