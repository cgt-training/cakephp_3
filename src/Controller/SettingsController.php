<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class SettingsController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $settings = $this->Settings->get('8');
        if ($this->request->is(['post','put'])) {
            $settings = $this->Settings->patchEntity($settings, $this->request->data);
            $settings->modified = date("Y-m-d H:i:s");
            if ($this->Settings->save($settings)) {
                $this->Flash->success(__('Your Theme has been Changed.'));
                return $this->redirect(['controller' => 'Posts','action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your post.'));
        }
        $this->set('post', $settings);  
    }

}


