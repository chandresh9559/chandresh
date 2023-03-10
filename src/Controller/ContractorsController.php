<?php

declare(strict_types=1);
namespace App\Controller;
class ContractorsController extends AppController

{

    public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);
        $this->loadModel('Users');
        $this->loadModel('UserProfile');
        $this->loadModel('Projects');
        $this->loadModel('OwnerServices');
        $this->loadModel('UserServices');
        $this->loadModel('Services');
        $this->loadModel('OwnerServices');
        $this->loadModel('AssignedUsers');
        $this->viewBuilder()->setLayout('scgc_layout');
       
    }

/*********************ScGc Profile ********************** */

    public function gcscProfile()
    {
        $auth = $this->Authentication->getIdentity();
        $id = $auth->id;
        
   
            $services = $this->paginate($this->Services->find('all')->where(['service_status'=>1]));
            $userservices = $this->UserServices->find('all')->contain('Services')->where(['user_id'=>$id])->all();
            $this->viewBuilder()->setLayout('scgc_layout');
            $gcsc = $this->Users->get($id,['contain' => ['UserProfile']]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                if($gcsc->complete_status == 0){
                    $data['complete_status'] = 1;
                }
                $user = $this->Users->patchEntity($gcsc, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['controller'=>'contractors','action' => 'assigned-project-list']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            $this->set(compact('gcsc','services' , 'auth','userservices'));
        
    }

/************************Assigned Project list********************* */

    public function assignedProjectList(){
        $auth = $this->Authentication->getIdentity();
            $assignedUsers =  $this->paginate($this->AssignedUsers->find('all')->contain(['Projects','Users','UserProfile'])->where(['assigned_userid'=>$auth->id]));
            $this->set(compact('assignedUsers'));
            
    }

/*********************Project Details************************ */
    public function projectDetails($id = null){
        $auth = $this->Authentication->getIdentity();
        
        $assigned =  $this->AssignedUsers->find('all')->contain(['Projects','Users','UserProfile'])->where(['AssignedUsers.id'=>$id])->first();
        $owner_services = $this->OwnerServices->find('all')->contain(['Services'])->where(['project_id'=>$assigned->project->id])->all();
        $this->set(compact('assigned','owner_services'));
    }

}
