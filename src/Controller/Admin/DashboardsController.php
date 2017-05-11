<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class DashboardsController extends AppController
{
	public function initialize(){
	    parent::initialize();
	    // Set the layout
	     $this->viewBuilder()->layout('dashboardview');
	}

	public function index()
    {
    	$sessionadmin = $this->request->session()->read("Auth.Admin");
    	// print_r($sessionadmin);exit();

    }
    public function display(){
    	
    }
}
?>
