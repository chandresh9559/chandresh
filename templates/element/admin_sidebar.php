<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <?php //$this->Html->image($auth->image, ['class' => 'user_img']) 
            ?>
      <span class="font-weight-bold text-white">Construction Management and <br>Lead Management</span>
        </a>
    </div>
    
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            
            <li class="nav-item">
                <?php echo $this->Html->link('<i class="fa fa-users"></i>' . __('Owner Managment'), ['controller' => 'users', 'action' => 'dhasboard','prefix'=>'Admin'], ['escape' => false, 'class' => 'nav-link text-light']) ?>
            </li>
            <li class="nav-item">
                <?php echo $this->Html->link('<i class="fa fa-user "></i>' . __('GC Management'), ['controller' => 'Contractor', 'action' => 'generalListing','prefix'=>'Admin'], ['escape' => false, 'class' => 'nav-link text-light']) ?>
            </li>
            <li class="nav-item">
                <?php echo $this->Html->link('<i class="fa fa-user opacity-10"></i>' . __('SC Management'), ['controller' => 'Contractor', 'action' => 'subListing','prefix'=>'Admin'], ['escape' => false, 'class' => 'nav-link text-light']) ?>
            </li>
            
            <li class="nav-item">
                <?php echo $this->Html->link('<i class="fa fa-wrench opacity-10"></i>' . __('Service Managment'), ['controller' => 'Services', 'action' => 'serviceManagment','prefix'=>'Admin'], ['escape' => false, 'class' => 'nav-link text-light users']) ?>
            </li>
          
             <!-- End Tables Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="fa fa-server"></i><span>Project Management</span>
                </a>
                
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
               
                <?php echo $this->Html->link('<i class="fa fa-check-to-slot" ></i>' . __('Assign Project'), ['controller' => 'Projects', 'action' => 'assignProject','prefix'=>'Admin'], ['escape' => false, 'class' => 'nav-link text-light users']) ?>  
                <?php echo $this->Html->link('<i class="fa fa-square-xmark"></i>' . __('Unassign Project'), ['controller' => 'Projects', 'action' => 'unAssignProject','prefix'=>'Admin'], ['escape' => false, 'class' => 'nav-link text-light users']) ?>    
                </ul>
            </li>
            <!-- End Tables Nav -->

            <li class="nav-item">
                <?php echo $this->Html->link('<i class="fa fa-sign-out opacity-10"></i>' . __('Logout'), ['controller' => 'Users', 'action' => 'logout','prefix'=>'Admin'], ['escape' => false, 'class' => 'nav-link text-light']) ?>
             </li>
            

        </ul>
    </div>
</aside>