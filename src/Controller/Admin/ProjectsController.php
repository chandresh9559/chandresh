<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Form\ContactForm;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\View\View;

class ProjectsController extends AppController{
    public function initialize(): void
    {
        parent::initialize();
         $this->loadModel('UserProfile');
         $this->loadModel('Users');
         $this->loadModel('Projects');
         $this->loadModel('OwnerServices');
         $this->loadModel('UserServices');
         $this->loadModel('Services');
         $this->loadModel('AssignedUsers');
        // $cars = $this->Cars->find('all')->contain(['Brands'=>function($q)use ($status){ return $q->where(['Brands.status'=>$status]);}]);
       
    }

    // Un Assign Project
    public function unAssignProject(){
        $this->viewBuilder()->setLayout('admin_layout');
        $projects =  $this->paginate($this->Projects->find('all')->contain(['Users','UserProfile']));
        
        $this->set(compact(['projects']));
    }

   // Project View
    public function projectView($id = null){
        $this->viewBuilder()->setLayout('admin_layout');
        $project = $this->Projects->get($id, [
            'contain' => ['Users','UserProfile'],
        ]);
        
        $owner_services = $this->OwnerServices->find('all')->contain(['Services'])->where(['project_id'=>$id])->all();
        $contractor = $project->contractor;
        $users = $this->Users->find('all')->contain(['UserProfile'])->where(['user_type'=>$contractor])->all();
        $assignuser = $this->AssignedUsers->find('all')->select(['assigned_userid'])->where(['project_id'=>$id])->all();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['controller'=>'projects','action' => 'unAssignProject','prefix'=>'Admin']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $this->set(compact('project','owner_services','users','assignuser'));

    }

    //Service view
    public function serviceView(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $id = $this->request->getQuery('id');
            $user_services = $this->UserServices->find('all')->contain(['Services'])->where(['user_id'=>$id])->all();
            $data = "";
           foreach($user_services as $user){
            $data ='<tr>
               <td>'.$user->service->service.'</td>
               </tr>';
             echo $data; 
            }
        }

    }

    // accecpt project
    public function accectOwnerProject($id = null){
        $this->autoRender = false;
        $project = $this->Projects->get($id, [
            'contain' => ['Users'],
        ]);

            $project->accept_status = 1;
            if($this->Projects->save($project)){
                $mailer = new Mailer('default');
                $mailer->setTransport('gmail'); //your email configuration name
                $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                $mailer->setTo($project->user->email);
                $mailer->setEmailFormat('text');
                $mailer->setSubject('Approve Your Account');
                $mailer->deliver('Dear Owener Your Project is Accepted');
                 $this->Flash->success(__('Accepted'));
                return $this->redirect(['controller' => 'Projects',  'prefix' => 'Admin','action' => 'projectView',$id]); 
            }
        
    }

    //project delete recover
    public function projectDeleteRecover($id = null){
        $this->autoRender = false;
                $project = $this->Projects->get($id, [
                    'contain' => ['Users'],
                ]);

                if($project->accept_status == 1 && $project->assigned_status == 1){
                    $project->accept_status = 2;
                    $project->assigned_status = 2;
                }else if($project->accept_status == 2 && $project->assigned_status == 2){
                    $project->accept_status = 1;
                    $project->assigned_status = 1;
                }
                if($project->accept_status == 2 &&  $project->assigned_status == 2){
                if($this->Projects->save($project)){
                $mailer = new Mailer('default');
                $mailer->setTransport('gmail'); //your email configuration name
                $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                $mailer->setTo($project->user->email);
                $mailer->setEmailFormat('text');
                $mailer->setSubject('Approve Your Account');
                $mailer->deliver('Dear Owner Your Project is Not Accepted');
                 $this->Flash->success(__('Your Project is Delete'));
                return $this->redirect(['controller' => 'Projects',  'prefix' => 'Admin','action' => 'unAssignProject']);
                } 
                }else{
                    if($this->Projects->save($project)){
                        $mailer = new Mailer('default');
                        $mailer->setTransport('gmail'); //your email configuration name
                        $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                        $mailer->setTo($project->user->email);
                        $mailer->setEmailFormat('text');
                        $mailer->setSubject('Approve Your Account');
                        $mailer->deliver('Dear Owner Your Project is Recover');
                         $this->Flash->success(__('Your Project is Recover'));
                        return $this->redirect(['controller' => 'Projects',  'prefix' => 'Admin','action' => 'assignProject']);
                        }   
                }
    }
    
    // assign project
    public function assign(){
        $this->autoRender = false;
        $assigned = $this->AssignedUsers->newEmptyEntity();
        $data = $this->request->getData();
      
        if ($this->request->is('ajax')) {
            $project_id = $this->request->getData('project_id');
            // dd($project_id); 
            $assign_user = $this->AssignedUsers->find('all')->where(['project_id'=>$project_id])->first();
            // $assign_user = $this->AssignedUsers->get($project_id);
            // dd($assign_user->project_id); 
            if(empty($assign_user->project_id)){

                foreach($data['assigned_userid'] as $val){
                    $assigned = $this->AssignedUsers->newEmptyEntity();
                    $assigned->user_id = $this->request->getData('user_id');
                    $assigned->project_id = $this->request->getData('project_id');
                    $assigned->assigned_userid = $val;
                    $this->AssignedUsers->save($assigned);

                }
                
                if ($this->AssignedUsers->save($assigned)) {
                    
                
                    
                    $project = $this->Projects->get($project_id,['contain'=>['Users','UserProfile']]);
                    // dd($project);
                    $project_name = $project['project_name'];
                    $owner_name = $project->user_profile['first_name'];
                    $owner_contact = $project->user_profile['phone'];
                    if($project->assigned_status == 0){
                        $project->assigned_status = 1;
                    }
                    if($this->Projects->save($project)){
                        $tests = array();
                        $name = array();
                        $phone = array();
                        foreach($data['email'] as $email){
                            $tests[] = $email;
                        }
                        $user_name =$this->request->getData('name');
                        foreach($user_name as $name_test){
                            $name[] = $name_test;
                        }
                        $user_phone =$this->request->getData('phone');
                        foreach($user_phone as $phone_test){
                            $phone[] = $phone_test;
                        }

                            $owner_email = $this->request->getData('owner_email');
                            if(isset($owner_email)){
                                $array_email = implode(',',$tests);
                                $array_name = implode(',',$name);
                                $array_phone = implode(',',$phone);
                                $mailer = new Mailer('default');
                                $mailer->setTransport('gmail'); //your email configuration name
                                $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                                $mailer->setTo($owner_email);
                                $mailer->setEmailFormat('html');
                                $mailer->setSubject('Assign Project');
                                $mailer->deliver('Your Project is assigned your contractor detail<br><p>Name : '.$array_name.'</p><br><p>Email : '.$array_email.'</p><br><p>Contact : '.$array_phone.'</p>');
                            }
                            $mailer = new Mailer('default');
                            $mailer->setTransport('gmail'); //your email configuration name
                            $mailer->setFrom(['chandreshck9559@gmail.com' => 'chandresh']);
                            $mailer->setTo($tests);
                            $mailer->setEmailFormat('html');
                            $mailer->setSubject('Assign Project');
                            $mailer->deliver('You have received a new lead<br>'.'Project Name ='.$project_name.'<br>'.'Owner Name ='.$owner_name.'<br>'.'Owner Contact ='.$owner_contact);
                        
                    }
                }
                echo 1;
            }else{
                echo 2;
                // $this->Flash->error(__('This Project Already Assigned'));
            }
        }
    }
    //xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx assign project xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx//
 
    // assign show 
    public function assignProject(){
        $this->viewBuilder()->setLayout('admin_layout');
        $projects =  $this->paginate($this->Projects->find('all')->contain(['Users','UserProfile'])->where(['AND'=>['assigned_status'=>1,'accept_status'=>1]]));
        $this->set(compact(['projects']));
    } 
}

?>