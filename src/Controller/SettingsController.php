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

        $loginid = $this->request->session()->read('Auth.User.id');//print_r($loginuser);
        if(!empty($loginid)){
            $settings = $this->Settings->newEntity();
            if ($this->request->is(['post','put'])) {
                $settings = $this->Settings->patchEntity($settings, $this->request->data);
                $settings->modified = date("Y-m-d H:i:s");
                $settings->user_id = $loginid;
                if ($this->Settings->save($settings)) {
                    $this->Flash->success(__('Your Theme has been Changed.'));
                    return $this->redirect(['controller' => 'Settings','action' => 'index']);
                }
                $this->Flash->error(__('Unable to update theme.'));
            }
            $this->set('post', $settings); 
        }else{
            return $this->redirect(['controller' => 'Users','action' => 'login']);
        }
    }
}


