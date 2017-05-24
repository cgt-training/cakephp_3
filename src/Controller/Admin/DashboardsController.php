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

    public function profile($id = null){
         $id = $this->request->session()->read('Auth.User.id');
        $users= TableRegistry::get('Users');
        $user = $users->get($id, [
            'contain' => []
        ]);
        $data = $users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) { //print_r($this->request->getData());exit;
            $user = $users->patchEntity($user, $this->request->getData());
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
            if ($users->save($user)) {
                $this->Flash->success(__('The Profile  has been saved.'));

                return $this->redirect(['action' => 'profile']);
            }
            $this->Flash->error(__('The Profile could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
}
?>
