<?php
namespace App\Controller\Admin;
class ServicesController extends AppController
{
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
        
       
    }
    
    // service show
    public function serviceManagment(){
        
        $this->viewBuilder()->setLayout('admin_layout');
        $services = $this->paginate($this->Services,['order'  => ['id' => 'DESC']]);
        $this->set(compact('services'));
    }
    // service add
    public function addServices()
    {
        $service = $this->Services->newEmptyEntity();
        if($this->request->is('ajax')){
           $this->autoRender = false;
        $data = $this->request->getData('service');
        $servise_data = $this->Services->find('all')->where(['service'=>$data])->first();
       if($servise_data){
            echo 0;
        }else{
            $service->service = $data;
            if ($this->Services->save($service)) {
                echo 1;
            }
        }
       }
        
    }

    // service dataget for edit
    public function editDataGet(){
        $id = $this->request->getQuery('id');
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $service = $this->Services->get($id, [
                'contain' => [],
            ]);
            echo json_encode($service);
            exit;
        }
    }


    // service edit 
    public function editService(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $id = $this->request->getData('id');
            $service = $this->Services->get($id, [
                'contain' => [],
            ]);
            $service->service = $this->request->getData('service');
            if ($this->Services->save($service)) {
                echo 1;
            }
            
        }
    }

    // service soft delete

    public function deleteRecoverService($id = null){
        $this->autoRender =false;
            $service = $this->Services->get($id);
            if($service->service_status == 1){
                $data = array('id' => $id, 'service_status' => 0);
            }else{
                $data = array('id' => $id, 'service_status' => 1);
            }
            $service = $this->Services->patchEntity($service,$data);
            if($this->Services->save($service)){
             return $this->redirect(['controller' => 'Services','action' => 'serviceManagment','prefix' => 'Admin']); 
            }
    }

    
    
}
