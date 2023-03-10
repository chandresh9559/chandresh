<?php

declare(strict_types=1);

namespace App\Controller;
use App\Form\ContactForm;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

         $this->Model = $this->loadModel('UserProfile');
         $this->Model = $this->loadModel('Services');
         

    }
  
    //===================== Owner Sign Up==========================//
    public function signUp()
    {

        $result = $this->Authentication->getIdentity();
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $email =$user->email;
                $result1 = $this->Users->checkEmailExist($email);
                if ($result1) {
                    $enc = rand();
                    $token = sha1('$enc');
                    $result = $this->Users->insertToken($email, $token);
                    if ($result) {
                        $user->email = $email;
                        $mailer = new Mailer('default');
                        $mailer->setTransport('gmail'); //your email configuration name
                        $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                        $mailer->setTo($email);
                        $mailer->setEmailFormat('html');
                        $mailer->setSubject('Verify New Account');
                        $mailer->deliver('<a href="http://localhost:8765/users/set-password/' . $token . '">Click here & Set Passowrd</a>');
                        $this->Flash->success(__('Regitration successfully , Open Mail and Set Password'));
                        return $this->redirect(['action' => 'login']);
                    }
                $this->Flash->error(__('Please enter valid credential..'));
                }
                $this->set(compact('user'));
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));

    }

    //==================Set New Password=====================//
    public function setPassword($token){
        $user = $this->Users->find('all')->where(['token'=>$token])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
        $user = $this->Users->patchEntity($user, $this->request->getData());
        $user->token = null;
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The Password has been saved.'));
            return $this->redirect(['action' => 'login']);
        }
        $this->Flash->error(__('The Password not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    //====================Owner login================//
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
       if ($result->isValid()) {
            $user = $this->Authentication->getIdentity();
            if($user->user_type == 1 && $user->status == 1 && $user->complete_status == 0){
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'users',
                    'action' => 'owner-profile',
                ]);
                return $this->redirect($redirect);
            }else if($user->user_type == 1 && $user->status == 1 && $user->complete_status == 1){
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Projects',
                    'action' => 'requested-project-list',
                ]);
                return $this->redirect($redirect);
            }else if($user->user_type == 2 && $user->status == 1 && $user->complete_status == 0){
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'contractors',
                    'action' => 'gcsc-profile',
                ]);
                return $this->redirect($redirect);
            }else if($user->user_type == 2 && $user->status == 1 && $user->complete_status == 1){
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'contractors',
                    'action' => 'assigned-project-list',
                ]);
                return $this->redirect($redirect);
            }else if($user->user_type == 3 && $user->status == 1 && $user->complete_status == 0){
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'contractors',
                    'action' => 'gcsc-profile',
                ]);
                return $this->redirect($redirect);
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }else if($user->user_type == 3 && $user->status == 1 && $user->complete_status == 1){
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'contractors',
                    'action' => 'assigned-project-list',
                ]);
                return $this->redirect($redirect);
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }else{
                $this->Authentication->logout();
                $this->Flash->error(__('Invalid email or password'));
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }

        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }
   

    //=================Owner Profile===================//
    public function ownerProfile()
    {
        $auth = $this->Authentication->getIdentity();
        $uid = $auth->id;
        $result = $this->Users->get($uid,['contain'=>['UserProfile']]);
        if($auth->user_type == 1){
            $this->viewBuilder()->setLayout('owner_layout');
            $owner = $this->Users->get($uid,['contain'=>['UserProfile']]);
            // dd($owner);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                // dd($data);
                if($owner->complete_status == 0){
                    $data['complete_status'] = 1;
                }
                $user = $this->Users->patchEntity($owner, $data);
                if ($this->Users->save($user)) {
                    
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['controller'=>'projects','action' => 'requested-project-list']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            $this->set(compact('owner','result'));
        }else{
            $this->Authentication->logout();
                return $this->redirect(['controller' => 'Users', 'action' => 'login']); 
        }
    }

    //===================Owner Logout===================//
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
    
}
