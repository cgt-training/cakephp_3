<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class SettingsController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $loginid = $this->request->session()->read('Auth.User.id');
        $query = $this->Settings->find()
                ->order(['id' => 'DESC'])->toArray();
        $settings = $this->Settings->newEntity();
        if ($this->request->is(['post','put'])) {
            $settings = $this->Settings->patchEntity($settings, $this->request->data);
            $settings->modified = date("Y-m-d H:i:s");
            $settings->name = $query[0]['name'];
            $settings->user_id = $loginid;
            if ($this->Settings->save($settings)) {
                $this->Flash->success(__('The language has been Changed.'));
                return $this->redirect(['controller' => 'Dashboards','action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the language.'));
        }
        $this->set('post', $settings);  
    }

}


