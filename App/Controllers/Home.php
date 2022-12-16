<?php

namespace App\Cms\Controllers;

use App\Cms\Model\ModelCustomer;
use App\Cms\Model\ModelHome;
use App\Cms\Model\ModelProject;
use Core\Cms\BaseController;

class Home extends BaseController
{
    public function Index()
    {
        $ModelHome = New ModelHome();
        $data['totals'] = $ModelHome->getTotals()['totals'];
        $data['projects'] = $ModelHome->getTotals()['projects'];

        $ModelProject = new ModelProject();
        $data['projects_table'] = $ModelProject->getProjectsByStatus();

        $ModelCustomer = new ModelCustomer();
        $data['customers_table'] = $ModelCustomer->getCustomers(5);


        $data["navbar"] = $this->view->load("static/navbar");
        $data["sidebar"] = $this->view->load("static/sidebar");

        echo $this->view->load('home/index',compact("data"));
    }
}