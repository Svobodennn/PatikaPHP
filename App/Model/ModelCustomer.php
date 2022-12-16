<?php

namespace App\Cms\Model;

use Core\Cms\BaseModel;
use Core\Cms\Session;

class ModelCustomer extends BaseModel
{
    public function createCustomer($data)
    {

        extract($data);
        $user = $this->db->connect->prepare('INSERT INTO customers set 
                          customers.name=?,
                          customers.surname=?,
                          customers.email=?,
                          customers.phone=?,
                          customers.gsm=?,
                          customers.adress=?,
                          customers.company=?
                          ');
        $insert = $user->execute([
            $name,
            $surname,
            $email,
            $phone,
            $gsm,
            $adress,
            $company
        ]);

            if($insert){
                return true;
            } else {
                return false;
            }
    }
    public function editCustomer($data)
    {

        extract($data);
        $user = $this->db->connect->prepare('update customers set 
                          customers.name=?,
                          customers.surname=?,
                          customers.email=?,
                          customers.phone=?,
                          customers.gsm=?,
                          customers.adress=?,
                          customers.company=? where customers.id=?
                          ');
        $update = $user->execute([
            $name,
            $surname,
            $email,
            $phone,
            $gsm,
            $adress,
            $company,
            $id
        ]);

            if($update){
                return true;
            } else {
                return false;
            }
    }

    public function getCustomers($limit = null){
        if ($limit==null){
       return  $this->db->query("Select * from customers",true);
    }else{

       return  $this->db->query("Select * from customers order by customers.id DESC limit $limit",true);
        }
    }
    public function getCustomer($id){
       return  $this->db->query("Select *  from customers where customers.id='$id'");
    }

    public function editNote($data){
        print_r($data);
        return true;
//        extract($data);
//        $user = $this->db->connect->prepare('update customers set
//                          customers.notes=?
//                          where customers.id=?
//                          ');
//        $update = $user->execute([
//            $html,
//            $id
//
//        ]);
//
//        if($update){
//            return true;
//        } else {
//            return false;
//        }

    }
}