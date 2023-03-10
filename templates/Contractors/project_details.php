
<div class="container-fluid px-2 px-md-4 mt-5">
   

        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"> Project Details</h6>
              </div>
            </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6 user-view">
        <div class="row">
            <div class="row">
                <div class="col">
                    <div class="card card-plain h-100">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12 col-xl-4 ms-5">
                                    <div class="card card-plain h-100">
                                    <div class="card-body p-3 ">
                                    <hr class="horizontal gray-light my-4">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Project Name :</strong> &nbsp; <?php echo $assigned->project->project_name ; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Owner Name :</strong> &nbsp; <?php echo $assigned->user_profile->first_name ; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp;  <?php echo $assigned->user_profile->phone ; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $assigned->user->email ; ?></li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Project Address1:</strong> &nbsp; <?php echo $assigned->project->project_address1 ; ?></li>
                                        
                                    </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-4">
                                <div class="card card-plain h-100">
                                    <div class="card-body p-3 ">
                                    <hr class="horizontal gray-light my-4">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Project Address2:</strong> &nbsp; <?php echo $assigned->project->project_address2 ; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">State:</strong> &nbsp; <?php echo $assigned->project->state ; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">City:</strong> &nbsp; <?php echo $assigned->project->city ; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Pin Code:</strong> &nbsp; <?php echo $assigned->project->pincode ; ?></li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row ms-5">
                            <h5>Services* :-</h5>
                            <div class="col-4 ms-5">
                                <div class="card-body p-3">
                                        <?php $count = 0;?>
                                        <?php foreach($owner_services as $service):?>
                                            
                                        <td><?php echo '<b>' .++$count.'</b>'.".".$service->service->service?></td>
                                        <?php endforeach;?>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

