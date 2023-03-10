<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Owner List</h6>
              </div>
              
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Sr No:</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ">Active/Inactive</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center  ">Approve</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center  ">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  $counter= 0; ?>
                      <?php $count = $this->Paginator->counter('{{start}}'); 
                      
                      foreach($users as $user){?>
                    <tr>
                    <td>
                        <p class="text-ms font-weight-bold mb-0"><?php echo  ++$counter ;?></p>
                        
                      </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class=" flex-column ">
                            <h6 class="mb-0 text-sm"><?php echo $user->user_profile->first_name.' '.$user->user_profile->last_name;?></h6>
                            <p class="text-xs text-secondary mb-0"></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-ms font-weight-bold mb-0 text-center"><?php echo $user->email ;?></p>
                        
                      </td>
                      <td class="align-middle text-center text-sm">
                      <?php if($user->status == 1) : ?>
                      <span class="badge badge-sm bg-gradient-success">
                        <?= $this->Form->postLink(__('Active'), [ 'controller' => 'users','prefix'=>'Admin','action' => 'activeInactive', $user->id], ['confirm' => __('Are you sure you want to Inactive?', $user->id)]) ?>                     
                      </span>
                      <?php else: ?> 
                        <span class="badge badge-sm bg-gradient-danger ">
                          <?= $this->Form->postLink(__("Deactive"), [ 'controller' => 'users','prefix'=>'Admin','action' => 'activeInactive', $user->id], ['confirm' => __('Are you sure you want to Active?', $user->id)]) ?>
                        </span>
                        <?php endif ; ?> 
                      </td>

                      <td class="align-middle text-center">
                        
                          <?php echo $this->Html->link(__('Click'), ['controller' => 'users', 'action' => 'approv','prefix'=>'Admin',$user->id], ['class' => 'nav-link text-dark']);?>
                    </td>
                  </span>
                      </td>
                       

                      <td class="align-middle text-center">
                      
                      <?php
                      echo $this->Html->link(__(''), ['controller' => 'users','prefix'=>'Admin','action' => 'ownerEdit', $user->id],['class'=>'fa-solid fa-eye  mx-3','id'=>$user->id]);
                      if($user->status == 2){
                        echo $this->Html->link(__(''), ['controller' => 'users','prefix'=>'Admin','action' => 'deleteRecover', $user->id], ['class'=>'fa-solid fa-recycle','id'=>'recycle',]);
                      }else{
                        echo $this->Html->link(__(''), ['controller' => 'users','prefix'=>'Admin','action' => 'deleteRecover', $user->id], ['class'=>'fa-sharp fa-solid fa-trash','id'=>'delete'],['confirm'=>'Are you sure you want to delete']);
                      }
                      ?>
                      </td>


                      </tr>
                      <?php 
                   
                    }?>
             
                   
                  </tbody>
                </table>
              
                <?= $this->Html->css(['cake']) ?>
                <div class="paginator">
                  <ul class="pagination">
                    <?= $this->Paginator->first('< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                      <?= $this->Paginator->numbers() ?>
                      <?= $this->Paginator->next(__('next') . ' >') ?>
                      <?= $this->Paginator->last(__('last') . ' >>') ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     

     
      
        