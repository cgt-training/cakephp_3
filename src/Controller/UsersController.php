<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

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
            if(!empty($this->request->data['user_image']['name'])){ 
                    //$this->P($this->request->data['product_image']);
                $fileName = $this->request->data['user_image']['name'];
                $ext = explode(".", $fileName);
                $extension = end($ext);
                $uniquesavename = time().uniqid(rand());
                $newfilename = $uniquesavename .".".$extension;
                $uploadPath = 'img/user_img/';
                $uploadFile = $uploadPath.$newfilename;
                $move = move_uploaded_file($this->request->data['user_image']['tmp_name'],$uploadFile);       //print_r($uploadFile);exit;
                if($move){
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    $user->user_image = $newfilename;
                    $user->created  = date("Y-m-d H:i:s");
                    $user->modified = date("Y-m-d H:i:s");

                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));
                        return $this->redirect(['action' => 'login']);
                    }
                    $this->Flash->error(__('Unable to add the user.'));
                }else{
                    $this->Users->error(__('Unable to upload file, please try again.'));
                }
              }else{
                $this->Users->error(__('Please choose a file to upload.'));
              }
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

