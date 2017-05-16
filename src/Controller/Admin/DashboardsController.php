<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class DashboardsController extends AppController
{
    //The default page of dashboard loads through index funtion.
	public function index()
    {
    	$sessionadmin = $this->request->session()->read("Auth.Admin");

    	$companies = TableRegistry::get('Companies');
    	$query = $companies->find();
    	$number = $query->count();
    	$this->set(compact('number'));
        
    	$branches = TableRegistry::get('Branches');
    	$query1 = $branches->find();
    	$number1 = $query1->count();
    	$this->set(compact('number1'));

    	$comments = TableRegistry::get('Comments');
    	$query2 = $comments->find();
    	$number2 = $query2->count();
    	$this->set(compact('number2'));

    	$posts = TableRegistry::get('Posts');
    	$query3 = $posts->find();
    	$number3 = $query3->count();
    	$this->set(compact('number3'));
    }
    
    public function display(){
    	
    }
}
?>
