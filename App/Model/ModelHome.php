<?php

namespace App\Cms\Model;

use Core\Cms\BaseModel;
use Core\Cms\Session;

class ModelHome extends BaseModel
{
    public function getTotals(){
       return  ['totals'=> $this->db->query(
           "SELECT (SELECT Count(c.id) from customers c) as total_customer,
                (SELECT Count(p.id) from projects p) as total_project,
                (SELECT COUNT(s.id) from system_users s) as system_users;")?? [],

           'projects'=> $this->db->query(
                   "SELECT COUNT(p.id) as total, status from projects p group by p.status",true)?? []


       ];
    }

}