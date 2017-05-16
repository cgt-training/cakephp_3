<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class UsersController extends AppController
{
	public function initialize(){
	    parent::initialize();
	     $this->viewBuilder()->layout('adminfrontend');
	}
	
    //Registered user can login to the application through this function
    public function login() {
        if (!empty($this->request->data) && $this->request->data['remember_me']) {
            
                if ($this->request->is('POST')) {

                    $user = $this->Auth->identify();
                    $cookieId= $user['id'];
                    $cookieName= $user['username'];
                    $user1 =  $this->Users->get($cookieId);
                    $cookiePass= $user1['password'];
                    $this->Cookie->configKey('UserBack', [

                        'expires' => '+1 days',
                        'httpOnly' => true

                    ]);

                    $this->Cookie->write('UserBack',
                        ['id'=>$cookieId, 'name' => $cookieName, 'pass' => $cookiePass]
                    );

                    if ($user) {
                            $this->Auth->setUser($user);
                            return $this->redirect($this->Auth->redirectUrl());
                        }
                    $this->Flash->error(__('Invalid username or password, try again'));
                }

        }else if(!empty($this->request->data) && $this->request->data['remember_me'] == 0) {

                   if ($this->request->is('post')) {

                        $user = $this->Auth->identify();
                        if ($user) {
                            $this->Auth->setUser($user);
                            return $this->redirect($this->Auth->redirectUrl());
                        }
                        $this->Flash->error(__('Invalid username or password, try again'));
                    } 
        } 
    }

    //The logged in  user can logout through this function
    public function logout()
    {
        $this->Cookie->delete('UserBack');
        $this->request->Session()->delete('Auth');
        return $this->redirect($this->Auth->logout());
    }


    public function register()
    {

    }

}
?>