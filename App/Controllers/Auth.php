<?php

namespace App\Cms\Controllers;

use Core\Cms\BaseController;
use Core\Cms\Session;

class Auth extends BaseController
{
    public function Index()
    {
        $data['form_link'] = _link('login');

        echo $this->view->load('auth/index',$data);
    }
    public function Login()
    {
        $data = $this->request->post();

        if (!$data['email']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Email adresinizi giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg  ]);
            exit();
        }
        if (!$data['password']){
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Parolanızı giriniz';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg ]);
            exit();
        }

        $AuthModel = new \App\Cms\Model\ModelAuth();
        $access = $AuthModel->userLogin($data);
        if ($access){
         $status = 'success';
         $title = 'İşlem başarılı';
         $msg = 'Giriş Yapılıyor';
         echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg, 'redirect'=>_link() ]);
         exit();
        }else{
            $status = 'error';
            $title = 'İşlem başarısız';
            $msg = 'Giriş Yapılamadı';
            echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
            exit();

        }

    }
    public function Logout()
    {

        Session::removeSession();
        redirect('login');
    }
}