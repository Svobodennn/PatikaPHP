<?php
namespace App\Cms\Controllers;

use App\Cms\Model\ModelUser;
use Core\Cms\BaseController;
use Core\Cms\Session;


class User extends BaseController {
    public function Index(){

        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");
        $data['user'] = Session::getAllSession();
        echo $this->view->load('user/index',compact('data'));
    }
    public function EditProfile(){
        $data= $this->request->post();

        if (!$data['name']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Ad bilgisine ulaşılamadı';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        if (!$data['surname']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Soyad bilgisine ulaşılamadı';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        if (!$data['email']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Eposta bilgisine ulaşılamadı';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        $ModelCustomer = new ModelUser();
        $insert = $ModelCustomer->editProfile($data);

        if ($insert){
            Session::setSession('name',$data['name']);
            Session::setSession('surname',$data['surname']);
            Session::setSession('email',$data['email']);
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Güncelledik ;) kıps';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Becere MEDIC';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }

    }
    public function ChangePassword(){
        $data= $this->request->post();
        if (!$data['password']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Lütfen geçerli şifreyi giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        if (!$data['new_password']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Lütfen yeni şifreyi giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        if (strlen($data['new_password']) < 6){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'En az 6 karakter giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        if (!$data['new_password_again']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Lütfen yeni şifreyi tekrar giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        if ($data['new_password']!=$data['new_password_again']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Şifreniz birbiriyle uyuşmuyor';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }
        if (md5($data['password'])!=Session::getSession('password')){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Lütfen geçerli şifrenizi doğru giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }


        $ModelUser = new ModelUser();
        $insert = $ModelUser->changePassword($data);

        if ($insert){
            Session::setSession('password',md5($data['new_password']));
            $status = 'success';
            $title = 'İşlem başarılı';
            $msg = 'Güncelledik ;) kıps';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Becere MEDIC';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }




//    public function Test(){
//        $this->view->load('test', ["isim" => "Melih"]);
//    }
//    public function getTest(){
//        $get = $this->request->get();
//        print_r($get);
//    }
}}