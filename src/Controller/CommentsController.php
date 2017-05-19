<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class CommentsController extends AppController
{ 
    public function index()
    {
       
    }

    public function comment()
    {
        
    } 
    
    public function add($id)
    {
        $comments= $this->loadModel('Comments');
        $user = $this->request->session()->read('Auth.User.id');
        $comment = $comments->newEntity();
        if ($this->request->is('post')) {
           
            $comment = $comments->patchEntity($comment, $this->request->getData());
            $comment->user_id =$user;
            $comment->created = date("Y-m-d H:i:s");
             $comment->post_id =$id;
            if ($comments->save($comment)) {
                $this->Flash->success(__('The Comment has been saved.'));

                return $this->redirect(['controller'=>'Posts','action' => 'comment',$id]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        } 
        $this->set(compact('comment'));
        $this->set('_serialize', ['comment']);

    }

     public function delete($id,$u_id)
    {
        $authuser_id = $this->request->session()->read('Auth.User.id');
        $comment = $this->Comments->get($id);
        if($authuser_id == $comment->user_id){
            $this->request->allowMethod(['post', 'delete']);
            if ($this->Comments->delete($comment)) {
                $this->Flash->success(__('The comment has been deleted.'));
            } else {
                $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
            }
            return $this->redirect(['controller' => 'Posts','action' => 'comment',$u_id]);
        }
        else{
             $this->Flash->error(__('You are not authorised to delete'));
             return $this->redirect(['controller' => 'Posts','action' => 'comment',$u_id]);
        }
    }

    public function editcomment($id ,$comment_id)
    {
        $comment = $this->Comments->get($comment_id, [
            'contain' => []
        ]);
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The Comment has been saved.'));
            }
        }
        return $this->redirect(['controller' => 'Posts','action' => 'comment',$id]);
    }
    
}
