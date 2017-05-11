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
	// public function login()
 //    { 
 //        if ($this->request->is('post')) {
 //            $user = $this->Auth->identify();
 //            if ($user) {
 //                $this->Auth->setUser($user);
 //                $this->_setCookie();
 //                return $this->redirect($this->Auth->redirectUrl());
 //            }
 //            $this->Flash->error(__('Invalid username or password, try again'));
 //        }
 //    }

    public function login() {


    if (!empty($this->request->data) && $this->request->data['remember_me']) {
        
            // $this->loadModel('Users');   
            if ($this->request->is('POST')) {

                $user = $this->Auth->identify();
                 
                $cookieId= $user['id'];
                
                $cookieName= $user['username'];
                // print_r($cookieName);exit;
                $cookiePass= $user['password'];
                 // print_r($cookiePass);exit;
                $this->Cookie->configKey('UserBack', [

                    'expires' => '+1 days',
                    'httpOnly' => true

                ]);

                $this->Cookie->write('UserBack',
                    ['id'=>$cookieId, 'name' => $cookieName, 'pass' => $cookiePass]
                );
                // print_r($abc);exit;
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

    // protected function _setCookie() {
    //     if (!$this->request->data('remember_me')) {
    //         return false;
    //     }
    //     $data = [
    //         'username' => $this->request->data('username'),
    //         'password' => $this->request->data('password')
    //     ];
    //     $this->Cookie->write('RememberMe', $data, true, '+1 week');
    //     return true;
    // }

    public function logout()
    {
         // print_r("UserLogout_back");exit();
        $this->Cookie->delete('UserBack');
        $this->request->Session()->delete('Auth');
        return $this->redirect($this->Auth->logout());
    }

    public function register()
    {

    }

}
?>