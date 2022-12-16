<?php

namespace App\Cms\Model;

use Core\Cms\BaseModel;
use Core\Cms\Session;

class ModelProject extends BaseModel
{
    public function createProject($data)
    {

        extract($data);
//       echo "<pre>"; var_dump($data); exit();
        $user = $this->db->connect->prepare('INSERT INTO projects set 
                          projects.customer_id=?,
                          projects.title=?,
                          projects.description=?,
                          projects.start_date=?,
                          projects.end_date=?,
                          projects.added_id=?,
                          projects.progress=?,
                          projects.status=?
                          ');
        $insert = $user->execute([
            $customer_id,
            $title,
            $description,
            $start_date,
            $end_date,
            intval(Session::getSession('id')) ,
            $progress,
            $status
        ]);

            if($insert){
                return true;
            } else {
                return false;
            }
    }
    public function editProject($data)
    {

        extract($data);
        $user = $this->db->connect->prepare('update projects set 
                          projects.customer_id=?,
                          projects.title=?,
                          projects.description=?,
                          projects.start_date=?,
                          projects.end_date=?,
                          projects.progress=?,
                          projects.status=? where projects.id=?
                          ');
        $update = $user->execute([
            $customer_id,
            $title,
            $description,
            $start_date,
            $end_date,
            $progress,
            $status,
            $project_id

        ]);

            if($update){
                return true;
            } else {
                return false;
            }
    }

    public function getProjects(){
       return  $this->db->query("Select projects.*, customer_id, concat(c.name,' ',c.surname) as customer_name from projects left join customers c on c.id=projects.customer_id",true);
    }
    public function getProjectsByStatus($status = 'a'){
       return  $this->db->query("Select projects.*, customer_id, concat(c.name,' ',c.surname) as customer_name from projects left join customers c on c.id=projects.customer_id where projects.status='$status'",true);
    }
    public function getProjectsByCustomerId($id){
       return  $this->db->query("Select * from projects where projects.customer_id='$id'",true);
    }
    public function getProject($id){
       return  $this->db->query("Select * from projects where projects.id='$id'");
    }

}