<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
     public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
    }

     public function index()
     {
        $this->set('users', $this->Users->find('all'));
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
           
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }

   
    public function login()
    {
        if (!empty($this->request->data) && $this->request->data['remember_me']) {
         // print_r($this->request->getData());exit();
           
            if ($this->request->is('POST')) {

                $user = $this->Auth->identify();
                
                $cookieId= $user['id'];

                $cookieName= $user['username'];

                $cookiePass= $user['password'];
                 // print_r($cookiePass);exit;
                $this->Cookie->configKey('UserFront', [

                    'expires' => '+1 days',
                    'httpOnly' => true

                ]);

                $this->Cookie->write('UserFront',
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

    public function logout()
    {

        $this->Cookie->delete('UserFront');
        $this->request->Session()->delete('Auth');
        return $this->redirect($this->Auth->logout());
    }
}

