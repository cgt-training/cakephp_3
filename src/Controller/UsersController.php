<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
    //Called during the Controller.shutdown event which is triggered after every controller action, and after rendering is complete.
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

    //The User can register through this function.
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

   //Registered user can login to the application through this function
    public function login()
    {
        if (!empty($this->request->data) && $this->request->data['remember_me']) {
           
            if ($this->request->is('POST')) {

                $user = $this->Auth->identify();
                
                $cookieId= $user['id'];
                $cookieName= $user['username'];
                $cookiePass= $user['password'];

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

    //The logged in  user can logout through this function
    public function logout()
    {

        $this->Cookie->delete('UserFront');
        $this->request->Session()->delete('Auth');
        return $this->redirect($this->Auth->logout());
    }
}

