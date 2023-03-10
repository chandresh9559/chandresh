<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;
class UsersController extends AppController{
/**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

     public function beforeFilter(\Cake\Event\EventInterface $event)
     {
         parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login']);
        
     }

    // admin login page
    public function login(){
        $this->viewBuilder()->setLayout('admin_login');
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity();
            if($user->user_type == 0 && $user->status == 1){
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'users',
                'action' => 'dhasboard',
                'prefix' => 'Admin'
            ]);

            return $this->redirect($redirect);
        }else{
            $this->Flash->error(__('Invalid email or password'));
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']); 
        }
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }
    //admin dhashboard
    public function dhasboard(){
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid,['contain'=>['UserProfile']]);
        $this->set(compact('admin'));
        $this->viewBuilder()->setLayout('admin_layout');
        $users =  $this->paginate($this->Users->find('all')->contain(['UserProfile'])->where(['user_type'=>1]));
        $this->set(compact('users','admin'));
    }


    //admin logout
    public function logout(){
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin']);
        }
    }

    public function approv($id = null){
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $admin = $this->Users->get($uid,['contain'=>['UserProfile']]);
        $this->set(compact('admin'));
        $this->autoRender = false;
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if($user->status == 0){
            $user->status = 1;
            if($this->Users->save($user)){
                $mailer = new Mailer('default');
                    $mailer->setTransport('gmail'); //your email configuration name
                    $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                    $mailer->setTo($user->email);
                    $mailer->setEmailFormat('text');
                    $mailer->setSubject('Approp Your Account');
                    $mailer->deliver('Dear Owener Your Account is Approved you login successfully');
                  
                    $this->Flash->success(__('Appropped Successfully'));

                    return $this->redirect(['controller' => 'Users', 'action' => 'dhasboard', 'prefix' => 'Admin']); 
            }
        }

    }
    // soft delete 
    public function deleteRecover($id = null){
       
            $this->autoRender =false;
           
            $users = $this->Users->get($id);
            if($users->status == 1){
                $data = array('id' => $id, 'status' => 2);
            }else{
                $data = array('id' => $id, 'status' => 1);
            }
            $users = $this->Users->patchEntity($users,$data);
           
            if($this->Users->save($users,['modified' => false])){
                return $this->redirect(['controller' => 'Users', 'action' => 'dhasboard', 'prefix' => 'Admin']); 
            }
    }

    // owner edit
    public function ownerEdit($id = null)
    {
        $auth = $this->Authentication->getIdentity();
        if($auth->user_type == 0){
            $uid = $auth->id;
            $admin = $this->Users->get($uid,['contain'=>['UserProfile']]);
            $this->set(compact('admin'));
            $this->viewBuilder()->setLayout('admin_layout');
            $user = $this->Users->get($id, [
                'contain' => ['UserProfile'],
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The users has been saved.'));

                    return $this->redirect(['controller' => 'Users', 'action' => 'dhasboard', 'prefix' => 'Admin']); 
                }else{
                $this->Flash->error(__('The users could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('user'));
        }else{
            $this->Flash->error(__('You are not authorize to access that page'));
            return $this->redirect(['controller'=>'users', 'action'=>'logout','prefix' => 'Admin']);
        }      
    }

    //Active Inactive  function

    public function activeInactive($id){
        $this->autoRender =false;
           
        $users = $this->Users->get($id);
        if($users->status == 1){
            $data = array('id' => $id, 'status' => 0);
        }else{
            $data = array('id' => $id, 'status' => 1);
        }
        $users = $this->Users->patchEntity($users,$data);
       
        if($this->Users->save($users,['modified' => false])){
            return $this->redirect(['controller' => 'Users', 'action' => 'dhasboard', 'prefix' => 'Admin']); 
        }
    }
    
   
}
