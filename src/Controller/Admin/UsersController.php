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
                    if ($user['role']=='Admin' || $user['role']=='Subadmin') {
                            $this->Auth->setUser($user);
                            return $this->redirect($this->Auth->redirectUrl());
                        }
                    $this->Flash->error(__('Invalid username or password, try again'));
                }

        }else if(!empty($this->request->data) && $this->request->data['remember_me'] == 0) {
                    //print_r($this->request->data);exit;
                   if ($this->request->is('post')) {

                        $user = $this->Auth->identify();
                        if ($user['role']=='Admin' || $user['role']=='Subadmin') {
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
    
    public function index()
    {
        $this->viewBuilder()->layout('dashboardview');
        $this->paginate = [
            'contain' => []
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['user']);
    }

     public function view($id = null)
    {
        $this->viewBuilder()->layout('dashboardview');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function edit($id = null){
        $this->viewBuilder()->layout('dashboardview');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $data = $this->Users->get($id, [
            'contain' => []
        ]);
        $query = $this->Users->find()
                ->where(['role' => 'Admin'])->toArray();
        $admincount = count($query);
        $subquery = $this->Users->find()
                ->where(['role' => 'Subadmin'])->toArray();
        $userrole=$data['role'];
       
        $subadmincount = count($subquery);
        if ($this->request->is(['patch', 'post', 'put'])) { 
            $user = $this->Users->patchEntity($user, $this->request->getData());
                if(!empty($this->request->data['user_image']['name'])){
                    $fileName = $this->request->data['user_image']['name'];
                    $ext = explode(".", $fileName);
                    $extension = end($ext);
                    $uniquesavename = time().uniqid(rand());
                    $newfilename = $uniquesavename .".".$extension;
                    $uploadPath = 'img/user_img/';
                    $uploadFile = $uploadPath.$newfilename;
                    $move = move_uploaded_file($this->request->data['user_image']['tmp_name'],$uploadFile);
                    if($move){
                        $user->user_image = $newfilename;
                    }
                }else{
                   $user->user_image = $data->user_image;   
                } 

            if($user->role == 'admin'){
                if($userrole == 'Admin'){
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The User has been saved.'));
                        return $this->redirect(['action' => 'index']);
                       }else{
                            $this->Flash->error(__('The User could not be saved. Please, try again.'));
                       }
                }
                else{
                    if($admincount < 1){
                        if ($this->Users->save($user)) {
                        $this->Flash->success(__('The User has been saved.'));
                        return $this->redirect(['action' => 'index']);}
                        else{
                            $this->Flash->error(__('The User could not be saved. Please, try again.'));
                        }
                    }
                    else{
                        $this->Flash->error(__('Only one admin is allow'));
                    }
                } 
            }
            else if($user->role == 'subadmin'){
                if($userrole == 'Subadmin'){
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The User has been saved.'));
                        return $this->redirect(['action' => 'index']);
                       }else{
                            $this->Flash->error(__('The User could not be saved. Please, try again.'));
                       }
                }
                else{
                    if($subadmincount < 1){
                        print_r($this->Users->save($user));exit(); 
                       if ($this->Users->save($user)) {

                        $this->Flash->success(__('The User has been saved.'));
                        return $this->redirect(['action' => 'index']);
                       }else{
                            $this->Flash->error(__('The User could not be saved. Please, try again.'));
                       }
                    }
                    else{
                        $this->Flash->error(__('Only one Subadmin is allow'));
                    }
                }  
            }else{
                if ($this->Users->save($user)) {
                $this->Flash->success(__('The User has been saved.'));
                return $this->redirect(['action' => 'index']);
                }else{
                   $this->Flash->error(__('The User could not be saved. Please, try again.')); 
               }
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
?>