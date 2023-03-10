<style>
    form {
        margin-left: 445px;
    }
    label.form-label {
        width: 229px;
    }
    input.btn.btn-primary {
        margin-left: 152px;
        margin-top: 28px;
    }
</style>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <?php if($project->accept_status == 1){?>
                            <h6 class="text-white text-capitalize ps-3">Project View
                                <?php echo $this->Html->link(__('Accepted'), ['controller' => 'Projects','prefix'=>'Admin','action' => 'accectOwnerProject',$project->id], ['class' => 'float-end btn btn-success me-5','style'=>'margin-top:-9px'])?>
                            </h6>
                        <?php }else{?>
                            <h6 class="text-white text-capitalize ps-3">Project View
                                <?php echo $this->Html->link(__('Accept Project'), ['controller' => 'Projects','prefix'=>'Admin','action' => 'accectOwnerProject',$project->id], ['class' => 'float-end btn btn-success me-5','style'=>'margin-top:-9px'])?>
                            </h6>
                        <?php }?>

                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <?php echo $this->Form->create($project,['id'=>'form']); ?>
                    <?php echo  $this->Form->control('project_name', ['class' => 'text-form', 'label' => ['class' => 'form-label']]); ?>
                    <?php echo  $this->Form->control('user_profile.first_name', ['class' => 'text-form', 'label' => ['class' => 'form-label']]); ?>
                    <?php echo  $this->Form->control('state', ['type' => 'phone', 'class' => 'text-form', 'label' => ['class' => 'form-label']]); ?>
                    <?php echo  $this->Form->control('city', ['class' => 'text-form', 'label' => ['class' => 'form-label']]); ?>
                    <?php echo  $this->Form->control('project_address1', ['class' => 'text-form', 'label' => ['class' => 'form-label']]); ?>
                    <?php echo  $this->Form->control('project_address2', ['class' => 'text-form', 'label' => ['class' => 'form-label']]); ?>
                    <?php echo  $this->Form->control('pincode', ['class' => 'text-form', 'label' => ['class' => 'form-label']]); ?>
                    <?php echo $this->Form->submit(__('edit'), ['class' => 'btn btn-primary']); ?>
                    <?php echo $this->Form->end(); ?>
                    <div class="row ms-5">
                        <h5>Services* :-</h5>
                        <div class="col-4 ms-5">
                            <div class="card-body p-3">
                                <?php $count = 0; ?>
                                <?php foreach ($owner_services as $service) : ?>

                                    <td><?php echo '<b>' . ++$count . '</b>' . "." . $service->service->service ?></td>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row ms-5">
                        <h5>Selected Contractor* :-
                             <?php if($project->contractor==2) {echo"GC";}else{
                                echo "SC";
                             }  ?></h5>
                        <div class="col-4">
                            <div class="card-body p-3">
                                <?php echo $this->Form->create(null,['id'=>'assigned-form'])?>
                                <input type="hidden" name="user_id" value="<?php echo $project->user_id?>">
                                <input type="hidden" name="project_id" value="<?php echo $project->id?>">
                                <input type="hidden" name="owner_email" value="<?php echo $project->user->email?>">
                                <?php foreach ($users as $user) : ?>
                                <div class="d-flex" style="width:450px;">
                                <input class="check" type="checkbox" name="assigned_userid[]" value="<?php echo $user->id?>" style="margin-bottom:10px;margin-left:7px">
                                <input type="hidden" name="email[]" value="<?php echo $user->email?>">
                                <input type="hidden" name="name[]" value="<?php echo $user->user_profile->first_name ; ?>">
                                <input type="hidden" name="phone[]" value="<?php echo $user->user_profile->phone ; ?>">
                                <label for="" style="margin-left:1px;"> <?php echo $user->user_profile->first_name ?></label>
                                <?php echo $this->Html->link(__(''), [], ['class' => 'fa-solid fa-eye  mx-3 view','data-id'=>$user->id]); ?>
                                </div>
                                <?php endforeach; ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row ms-5">
                        <h5>Already Assigned :
                             <?php if($project->contractor==2) {echo"GC";}else{
                                echo "SC";
                             }  ?></h5>
                        <div class="col-4">
                            <div class="card-body p-3">
                                <?php echo $this->Form->create(null,['id'=>'assigned-form'])?>
                                <input type="hidden" name="user_id" value="<?php echo $project->user_id?>">
                                <input type="hidden" name="project_id" value="<?php echo $project->id?>">
                                <input type="hidden" name="owner_email" value="<?php echo $project->user->email?>">
                                <?php
                                foreach($assignuser as $assign){
                                    foreach ($users as $user) { 
                                        if($assign->assigned_userid == $user->id){
                                        ?>
                                        
                                <div class="d-flex" style="width:450px;">
                                <input class="check" type="checkbox" name="assigned_userid[]" value="<?php echo $user->id?>" style="margin-bottom:10px;margin-left:7px">
                                <input type="hidden" name="email[]" value="<?php echo $user->email?>">
                                <input type="hidden" name="name[]" value="<?php echo $user->user_profile->first_name ; ?>">
                                <input type="hidden" name="phone[]" value="<?php echo $user->user_profile->phone ; ?>">
                                <label for="" style="margin-left:1px;"> <?php echo $user->user_profile->first_name ?></label>
                                <?php echo $this->Html->link(__(''), [], ['class' => 'fa-solid fa-eye  mx-3 view','data-id'=>$user->id]); ?>
                                </div>
                                <?php }}} ?>
                                <?php echo $this->Form->submit(__('Assign'), ['class' => 'btn btn-primary']); ?>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- model show  -->

    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Service Name</th>
                            </tr>
                        </thead>
                        <tbody id = "show">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>