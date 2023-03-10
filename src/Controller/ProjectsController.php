<?php
declare(strict_types=1);

namespace App\Controller;


class ProjectsController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();

         $this->Model = $this->loadModel('UserProfile');
         $this->Model = $this->loadModel('Users');
         $this->Model = $this->loadModel('Services');
         $this->Model = $this->loadModel('Projects');
         $this->Model = $this->loadModel('AssignedUsers');
        
        
    }
    public function requestedProjectList()
    {   
        
        $auth = $this->Authentication->getIdentity();
        if($auth->user_type == 1){
            $uid = $auth->id;
            $this->viewBuilder()->setLayout('owner_layout');
            // $user = $this->paginate($this->Users,['contain'=>['UserProfile','AssignedUsers']]);
            $projects = $this->Projects->find('all')->where(['user_id'=>$uid])->all();
            // $pro = array();
            // foreach($projects as $project){
            //     $pro[] = $project->id;
            // }

            // $user = $this->AssignedUsers->find('all')->where(['project_id'=>$pro[]])->all();
            // dd($user);
            $this->set(compact('projects'));
           
        }else{
            $this->Flash->error(__('You are not authorize to access that page'));
            return $this->redirect(['controller'=>'contractors', 'action'=>'assigned-project-list']);
        }
    }

    public function view($id = null)
    {
        $auth = $this->Authentication->getIdentity();
        if($auth->user_type == 1){
            $project = $this->Projects->get($id, [
                'contain' => ['Users', 'AssignedUsers', 'OwnerServices'],
            ]);

            $this->set(compact('project'));
        }else{
            $this->Flash->error(__('You are not authorize to access that page'));
            return $this->redirect(['controller'=>'contractors', 'action'=>'assigned-project-list']);
        }    
    }

/********************view*********************/
    
    public function requestNewProject()
    {
        $this->viewBuilder()->setLayout('owner_layout');
        $auth = $this->Authentication->getIdentity();
        if($auth->user_type == 1){
            $services = $this->paginate($this->Services);
            $project = $this->Projects->newEmptyEntity();
            if ($this->request->is('post')) {
                // dd($this->request->getData());
                $project['user_id']=$auth->id;
                $project = $this->Projects->patchEntity($project, $this->request->getData());
            
                // dd($project);
                if ($this->Projects->save($project)) {
                    $this->Flash->success(__('The project has been saved.'));

                    return $this->redirect(['controller'=>'projects','action' => 'requested-project-list']);
                }
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
            $this->set(compact('project', 'services','auth'));
        }else{
            $this->Flash->error(__('You are not authorize to access that page'));
            return $this->redirect(['controller'=>'contractors', 'action'=>'assigned-project-list']);
        }  
    }

    
    public function edit($id = null)
    {
        $auth = $this->Authentication->getIdentity();
        if($auth->user_type == 1){
            $project = $this->Projects->get($id, [
                'contain' => [],
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $project = $this->Projects->patchEntity($project, $this->request->getData());
                if ($this->Projects->save($project)) {
                    $this->Flash->success(__('The project has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The project could not be saved. Please, try again.'));
            }
            $users = $this->Projects->Users->find('list', ['limit' => 200])->all();
            $this->set(compact('project', 'users'));
        }else{
            $this->Flash->error(__('You are not authorize to access that page'));
            return $this->redirect(['controller'=>'contractors', 'action'=>'assigned-project-list']);
        }     
    }

    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // public function assignedUsers(){
    //     $id = $_GET['id'];
    //     $assigned_user = $this->AssignedUsers->find('all')->where(['project_id'=>$id])->all();
    //     echo json_encode($assigned_user);
    //     exit;
    // }
    public function viewContractor($id = null){
      
        $this->viewBuilder()->setLayout('owner_layout');
        $assignuser = $this->AssignedUsers->find('all')->select(['assigned_userid'])->where(['project_id'=>$id])->all();
        $users = $this->Users->find('all')->contain(['UserProfile'])->all();
        
        $this->set(compact('users','assignuser'));
    }
}
