<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class UsersController extends AppController
{
	public function initialize(){
	    parent::initialize();
	    // Set the layout
	     $this->viewBuilder()->layout('adminfrontend');
	}
	public function login()
    { 
        if ($this->request->is('post')) {
        	// print_r($this->request->getData());exit();
            $user = $this->Auth->identify();
            // print_r($user);exit();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        $this->request->Session()->delete('Auth.Admin');
        return $this->redirect($this->Auth->logout());
    }

    public function register()
    {

    }

}
?>