<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Sub Contaractor List</h6>
              </div>
              
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sr No:</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Sub-Contractor Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Approve</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Active/Inactive</th>
                      <th class="text-secondary opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $count = $this->Paginator->counter('{{start}}'); 
                      foreach($users as $user){?>
                    <tr>
                    <td>
                      <div>
                        <?php echo $count; ?> 
                      </div>
                    </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $user->user_profile->first_name.' '.$user->user_profile->last_name;?></h6>
                         </div>
                        </div>
                      </td>
                      <td>
                      <p ><?php echo $user->email;?></p></p>
                    </td>
                    <td>
                   <?php echo $this->Html->link(__('Click'), ['controller' => 'Contractor', 'action' => 'subApprov','prefix'=>'Admin',$user->id], ['class' => 'nav-link text-dark']);?>
                    </td>
                    <td>
                      <?php
                      if($user->status == 1){
                        echo $this->Html->link(__('Active'), ['controller' => 'Contractor','prefix'=>'Admin','action' => 'subActiveInactive', $user->id],);
                      }else{
                          echo $this->Html->link(__('Inactive'), ['controller' => 'Contractor','prefix'=>'Admin','action' => 'subActiveInactive', $user->id],['confirm'=>'Your Account is Actiavate']);
                        }
                        ?>
                    </td>
                      <td class="align-middle">
                      
                        <?php
                        echo $this->Html->link(__(''), ['controller' => 'Contractor','prefix'=>'Admin','action' => 'subContractorEdit', $user->id],['class'=>'fa-solid fa-eye  mx-3','id'=>$user->id]);
                        if($user->status == 2){
                          echo $this->Html->link(__(''), ['controller' => 'Contractor','prefix'=>'Admin','action' => 'subDeleteRecover', $user->id], ['class'=>'fa-solid fa-recycle','id'=>'recycle',]);
                        }else{
                          echo $this->Html->link(__(''), ['controller' => 'Contractor','prefix'=>'Admin','action' => 'subDeleteRecover', $user->id], ['class'=>'fa-sharp fa-solid fa-trash','id'=>'delete'],['confirm'=>'Are you sure you want to delete']);
                        }
                        ?>
                        </td>
                    </tr>
                    <?php 
                    $count++;
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
     

     
      
        