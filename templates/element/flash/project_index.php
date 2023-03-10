<div class="table-responsive p-0 mt-4">
    <table class="table align-items-center mb-0">
        <thead>

            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Sr.</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Project Name</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Assigned Status</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Acceptance Status</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Created Date</th>
            <th class="text-uppercase text-secondary text-xs font-weight-bolder">Assigned Contractor</th>
        </thead>
        <tbody>
            <?php $count = 0; ?>
            <?php foreach($projects as $project): ?>
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td><?php echo $project->project_name ; ?></td>
                    <td>
                        <?php if($project->assigned_status == 0){?>
                            <?php echo 'Not Assigned'; ?>
                        <?php }else{?>    
                            <?php echo h('Assigned')?>
                        <?php }?>  
                    </td>  
                    <td>
                        <?php if($project->accept_status == 0){?>
                            <span class="badge badge-sm bg-gradient-warning text-xxs">
                            <?php echo 'Pending'; ?>
                        </span>
                        <?php }else{?>
                            <span class="badge badge-pill bg-gradient-success text-xxs">
                            <?php echo 'Accepted'; ?>
                        </span>
                        <?php }?>  
                    </td>
                    <td><?php echo h($project->created_date)?></td>
                    <td>
                        <?php echo $this->Html->link(__('<i style="margin-left:50px;font-size:18px" class="fa fa-eye"></i>'),['controller'=>'projects','action'=>'view-contractor',$project->id],['escape'=>false,])?>
                     </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>