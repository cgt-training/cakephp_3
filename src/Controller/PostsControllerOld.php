<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $post = $this->paginate($this->Posts);
        $this->set(compact('post'));
        $this->set('_serialize', ['post']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    { //print_r($this->Posts);exit;
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {

            $post = $this->Posts->patchEntity($post, $this->request->getData());
            $post->created = date("Y-m-d H:i:s");
            $post->modified = date("Y-m-d H:i:s");
            //$newData = ['user_id' => $this->Auth->user('id')];
           // $post = $this->Posts->patchEntity($post, $newData);
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('post'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $this->set(compact('post'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

     public function comment($id = null)
    {
       // print_r($id);exit;

        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        $this->set('post', $post);
        $this->set('_serialize', ['post']);

        $comments = TableRegistry::get('Comments');
        
        $user = $this->request->session()->read('Auth.User.username');
           // print_r($this->request->session()->read('Auth.User.username'));exit;

        //  $comment = $comments->newEntity();
        // if ($this->request->is('post')) {
           
        //     $comment = $comments->patchEntity($comment, $this->request->getData());
        //      $comment->user_id =$user;
        //     $comment->created = date("Y-m-d H:i:s");
        //      $comment->post_id =$id;
        //     if ($comments->save($comment)) {
        //         $this->Flash->success(__('The Comment has been saved.'));

        //         return $this->redirect(['action' => 'comment',$id]);
        //     }
        //     $this->Flash->error(__('The post could not be saved. Please, try again.'));
        // }
       
        // $this->set(compact('comment'));
        // $this->set('_serialize', ['comment']);

        $result=$comments->find('all')
                 ->where(['Comments.post_id' => $id ])
                 ->contain('Users')
                 ->toArray();
                 // print_r($result->toArray());exit();
                 $this->set(compact('result'));

        $users = TableRegistry::get('Users');
        //print_r($id);exit;
        // $query = $users->find('all');print_r($query);exit;
       // $query->select(['username'])
       //      ->leftJoinWith($comments)
       //      ->where(['Users.user_id'=='Comments.id']);

        $u_id = $this->request->session()->read('Auth.User.id');
        // print_r($u_id);exit;
       $queryresult = $users->find()
        ->hydrate(false)
        ->join([
            'table' => 'comments',
            'alias' => 'c',
            'type' => 'INNER',
            'conditions' => 'c.user_id ='.$u_id,
        ])->toArray();    
    // print_r($queryresult[0]['username']);exit;
    // $query = $queryresult[0]['username'];
    // $this->set(compact('query'));
    // $this->set('_serialize', ['query']);


    }
}
