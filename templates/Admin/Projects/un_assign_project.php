<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Unassign Project</h6>
              </div>
              
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sr No:</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Owner Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created Date</th>
                      <th class="text-secondary opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $count = $this->Paginator->counter('{{start}}'); 
                      foreach($projects as $project){
                        if($project->assigned_status == 0 && $project->accept_status == 0 || $project->assigned_status == 2 && $project->accept_status == 2){
                        ?>
                    <tr>
                    <td>
                      <div>
                        <?php echo $count; ?> 
                      </div>
                    </td>
                    <td>
                     
                        <?php echo $project->project_name; ?> 
                      
                    </td>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $project->user_profile->first_name.' '.$project->user_profile->last_name;?></h6>
                         </div>
                        </div>
                      </td>
                      <td>
                      <p ><?php echo $project->created_date;?></p></p>
                    </td>
                  
                   
                      <td class="align-middle">
                      
                        <?php
                        echo $this->Html->link(__(''), ['controller' => 'Projects','prefix'=>'Admin','action' => 'projectView', $project->id],['class'=>'fa-solid fa-eye  mx-3']);
                        if(($project->assigned_status == 2 && $project->accept_status == 2)){
                          echo $this->Html->link(__(''), ['controller' => 'Projects','prefix'=>'Admin','action' => 'projectDeleteRecover', $project->id], ['class'=>'fa-solid fa-recycle','id'=>'recycle',]);
                        }
                        ?>
                        </td>
                    </tr>
                    <?php
                        } 
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