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
    public $components = ['Paginator'];

    public $paginate = [
        'limit' => 10,
        'order' => [
            'Posts.title' => 'asc'
        ]
    ];
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    //The default page of post load by this function.
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
     //User can view the data of perticular post.
    public function view($id = null)
    { 
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
     //User can add the post by this function.
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {

            $post = $this->Posts->patchEntity($post, $this->request->getData());
            $post->created = date("Y-m-d H:i:s");
            $post->modified = date("Y-m-d H:i:s");
            $post->user_id = $this->request->session()->read('Auth.User.id');
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
     //User can edit the post data by edit function.
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
    //User can delete the perticular post by delete function.
    public function delete($id = null)
    {
        $userid = $this->request->session()->read('Auth.User.id');
        $post = $this->Posts->get($id);
        if($userid == $post['user_id']){
            $this->request->allowMethod(['post', 'delete']);
            if ($this->Posts->delete($post)) {
                $this->Flash->success(__('The post has been deleted.'));
            } else {
                $this->Flash->error(__('The post could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }
        else{
            $this->Flash->error(__('You are not authorized.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    //User can perform comment operation through this function.
     public function comment($id ,$comment_id= null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        $this->set('post', $post);
        $this->set('_serialize', ['post']);

        $comments = TableRegistry::get('Comments');
        $user = $this->request->session()->read('Auth.User.username');
        $result=$comments->find('all')
                 ->where(['Comments.post_id' => $id ])
                 ->contain('Users')
                 ->toArray();
                 $this->set(compact('result'));

        $users = TableRegistry::get('Users');
        $u_id = $this->request->session()->read('Auth.User.id');
        $queryresult = $users->find()
        ->hydrate(false)
        ->join([
            'table' => 'comments',
            'alias' => 'c',
            'type' => 'INNER',
            'conditions' => 'c.user_id ='.$u_id,
        ])->toArray(); 
    }
}
