<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    //It can build  the layout of website frontend as well as backed.It can load components like auth,cookie,flash etc. They used in every controller of application. 
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');

        if(isset($this->request->prefix) && ($this->request->prefix == 'admin')){
            $this->viewBuilder()->layout('dashboardview');
            $this->loadComponent('Cookie');
            $this->loadComponent('Auth', [ 
                'loginRedirect' => [
                'controller' => 'Dashboards',
                'action' => 'index',
                'prefix' => 'admin',
                ],
                'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => 'admin',
                ],
                'authenticate' => [
                    'Form' => [
                        'fields' => ['username' => 'username', 'password' => 'password']
                    ]
                ],
            ]);
        }
        else {
            $this->viewBuilder()->layout('frontend');
            $this->loadComponent('Auth', [
                'loginRedirect' => [
                    'controller' => 'Forms',
                    'action' => 'index',
                   
                ],
                'logoutRedirect' => [
                    'controller' => 'Forms',
                    'action' => 'index',
                   

                ],
                'authenticate' => [
                    'Form' => [
                        'fields' => ['username' => 'username', 'password' => 'password']
                    ]

                ],
            ]);

        }
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        $this->checkCookie();
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    //Called after controller action logic, but before the view is rendered.
    public function beforeRender(Event $event)
    {   
        $loginid = $this->request->session()->read('Auth.User.id');
        $themes = TableRegistry::get('Settings');
        $query = $themes->find()
                ->where(['user_id' =>$loginid])
                ->order(['id' => 'DESC'])
                ->toarray();
        // print_r( $query);exit;
        if(!empty($query)){
            $name     = $query[0]['name'];
            $language = $query[0]['language'];
           
            if(!empty($language) && !empty($loginid)){
                I18n::locale($language);    
            }else{
                I18n::locale('en_US');
            }
            if($name == '2'){
                $this->viewBuilder()->theme('Readysocial');
            }else{

            }
        }else{

        }

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    //Called during the Controller.shutdown event which is triggered after every controller action, and after rendering is complete.
    public function beforeFilter(Event $event)
    {
        if(isset($this->request->prefix) && ($this->request->prefix == 'admin')){

            $this->Auth->allow(['login']);
        }else{

            $this->Auth->allow(['index','login']);
        }
    }

    //Used to read the cookie
    function checkCookie(){

        $session = $this->request->session()->read("Auth");
        $this->loadModel('Users');
        if(empty($session))
        {   
            if(isset($this->request->prefix) && ($this->request->prefix == 'admin')){
                  
                    $cookieId = $this->Cookie->read('UserBack.id');
                    $cookieUser = $this->Cookie->read('UserBack.name');
                    $cookiePass = $this->Cookie->read('UserBack.pass');
                    $cookie = ['username' => $cookieUser, 'password'=> $cookiePass]; 
                    if (!is_null($cookie)) 
                    {
                        $user1 = $this->Users->findByUsername($cookie['username'])->toArray();
                        if (!empty($user1[0])) 
                        {
                            $this->Auth->setUser($user1[0]);
                            $this->redirect($this->Auth->redirectUrl());
                        }
                        else 
                        { 
                            $this->Cookie->delete('UserBack');
                        }
                    }else {

                            $this->redirect($this->Auth->redirectUrl());
                    }
            }
            else{
                $cookieId = $this->Cookie->read('UserFront.id');
                $cookieUser = $this->Cookie->read('UserFront.name');
                $cookiePass = $this->Cookie->read('UserFront.pass');

                $cookie = ['username' => $cookieUser, 'password'=> $cookiePass]; 
                
                if (!is_null($cookie)) 
                {
                    
                    $user1 = $this->Users->findByUsername($cookie['username'])->toArray();
                    
                    if (!empty($user1[0])) 
                    {
                        $this->Auth->setUser($user1[0]);
                        $this->redirect($this->Auth->redirectUrl());
                    }
                    else 
                    { 
                        $this->Cookie->delete('UserFront');
                    }
                }else {

                        $this->redirect($this->Auth->redirectUrl());
                }
            }
        }
    }
}
