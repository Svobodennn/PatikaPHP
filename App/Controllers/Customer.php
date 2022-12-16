<?php

namespace App\Cms\Controllers;

use App\Cms\Model\ModelProject;
use Core\Cms\BaseController;
use App\Cms\Model\ModelCustomer;

class Customer extends BaseController
{
    public function Index()
    {
        $ModelCustomer = new ModelCustomer();


        $data['customers'] = $ModelCustomer->getCustomers();

        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");
        echo $this->view->load('customer/index', compact("data"));
    }

    public function Add()
    {
        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");
        echo $this->view->load('customer/add', compact("data"));
    }

    public function Edit($id)
    {
        $ModelCustomer = new ModelCustomer();
        $data['customer'] = $ModelCustomer->getCustomer($id);


        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");
        echo $this->view->load('customer/edit', compact("data"));
    }
    public function Detail($id)
    {
        $ModelProject = new ModelProject();
        $data['projects'] = $ModelProject->getProjectsByCustomerId($id);

        $ModelCustomer = new ModelCustomer();
        $data['customer'] = $ModelCustomer->getCustomer($id);


        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");
        echo $this->view->load('customer/detail', compact("data"));
    }

    public function CreateCustomer(){
        $data= $this->request->post();
        if (!$data['name'] || !$data['surname']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Müşteri adını ve soyadını giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        $ModelCustomer = new ModelCustomer();
        $insert = $ModelCustomer->createCustomer($data);

        if ($insert){
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Müşteri eklendi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg, 'redirect'=>_link('customer') ]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Müşteri eklenemedi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }


    }

    public function RemoveCustomer(){
        $data= $this->request->post();
        if (!$data['id']){

            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Müşteri bilgisi alınamadı';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        $remove = $this->db->remove("delete from customers where customers.id = '{$data['id']}' ");

        if ($remove){
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Müşteri Silindi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg, 'removed'=>$data['id']]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Müşteri silinemedi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }


    }

    public function EditCustomer(){
        $data= $this->request->post();
        if (!$data['id']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Müşteri bilgisine ulaşılamadı';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        $ModelCustomer = new ModelCustomer();
        $insert = $ModelCustomer->editCustomer($data);

        if ($insert){
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Müşteri eklendi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg, 'redirect'=>_link('customer') ]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Müşteri eklenemedi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }


    }
    public function TakeNote($id){
        $data= $this->request->post();
        $data['id'] = $id;
        if (!$data['html']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Bir şey oldu';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        $Model = new ModelCustomer();
        $insert = $Model->editNote($data);

        if ($insert){
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Not eklendi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg, 'redirect'=>_link('customer') ]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Not eklenemedi';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }


    }
}