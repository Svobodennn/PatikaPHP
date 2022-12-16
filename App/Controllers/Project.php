<?php

namespace App\Cms\Controllers;

use App\Cms\Model\ModelCustomer;
use App\Cms\Model\ModelProject;
use Core\Cms\BaseController;

class Project extends BaseController
{
    public function Index()
    {
        $ModelProject = new ModelProject();


        $data['projects'] = $ModelProject->getProjects();

        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");
        echo $this->view->load('project/index',compact("data"));
    }
    public function Add()
    {
        $ModelCustomer = new ModelCustomer();
        $data['customer'] = $ModelCustomer->getCustomers();

        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");
        echo $this->view->load('project/add',compact("data"));
    }
    public function Edit($id)
    {
        $ModelProject = new ModelProject();
        $data['project'] = $ModelProject->getProject($id);
        $ModelCustomer = new ModelCustomer();
        $data['customer'] = $ModelCustomer->getCustomers();


        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");
        echo $this->view->load('project/edit',compact("data"));
    }

    public function CreateProject(){
        $data= $this->request->post();
//        echo "<pre>"; var_dump($data); exit();
        if (!$data['title']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Lütfen proje adını giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        $ModelProject = new ModelProject();
        $insert = $ModelProject->createProject($data);

        if ($insert){
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Müşteri eklendi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg, 'redirect'=>_link('project') ]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Müşteri eklenemedi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }


    }

    public function EditProject(){
        $data= $this->request->post();
        if (!$data['project_id']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Proje bilgisine ulaşılamadı';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        $ModelProject = new ModelProject();
        $insert = $ModelProject->editProject($data);

        if ($insert){
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Proje eklendi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg, 'redirect'=>_link('customer') ]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Proje eklenemedi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }


    }

    public function RemoveProject(){
        $data= $this->request->post();
        if (!$data['project_id']){

            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Proje bilgisi alınamadı';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        $remove = $this->db->remove("delete from projects where projects.id = '{$data['project_id']}' ");

        if ($remove){
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Proje Silindi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg, 'removed'=>$data['project_id']]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Proje silinemedi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }


    }

}