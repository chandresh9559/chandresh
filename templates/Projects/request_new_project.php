<?php
$myTemplates = [
    'inputContainer'=>'<div class="input-group input-group-outline ">{{content}}</div>'
];
$this->Form->setTemplates($myTemplates);
?>
<style>
  .err{
        color: red;
    }
</style>
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6 user-view">
        <div class="row">
            <div class="row">
                <div class="col">
                    <div class="card card-plain h-100">
                  
                    <div class="card-header">
                    <h4 class="font-weight-bolder text-center">Request for New Project</h4>
                    <p class="mb-0 text-center">Enter details to request a new project</p>
                    </div>
                    <div class="card-body">
                            <?php echo $this->Form->create($project , ['id' => 'projects_form']) ?>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4 mt-3">
                                  <!-- <input type="hidden" name="user_id" value="<?php echo $auth->id?>"> -->
                                    <label for="">Project Name<span class="err">*</span></label>
                                    <?php echo $this->Form->control('project_name', ['required' => false, 'class' => 'form-control ', 'label' =>false]) ?>
                                    <label for="">State<span class="err">*</span></label>
                                    <?php echo $this->Form->control('state', ['required' => false, 'class' => 'form-control', 'label' =>false]) ?>
                                    <label for="">City<span class="err">*</span></label>
                                    <?php echo $this->Form->control('city', ['required' => false, 'class' => 'form-control ', 'label' =>false]) ?>
                                  </div>
                                  <div class="col-md-4 mt-3">
                                  <label for="">Project Address1<span class="err">*</span></label>
                                  <?php echo $this->Form->control('project_address1', ['required' => false, 'class' => 'form-control ', 'label' =>false]) ?>
                                    <label for="">Project Address2</label>
                                    <?php echo $this->Form->control('project_address2', ['required' => false, 'class' => 'form-control', 'label' =>false]) ?>
                                    <label for="">Pincode<span class="err">*</span></label>
                                    <?php echo $this->Form->control('pincode', ['required' => false, 'class' => 'form-control', 'label' =>false]) ?>
                                </div>
                              <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                             <div class="col-md-2"></div>
                              <div class="col-md-10">
                                <label for="" style="font-weight:bold">Type of Contractor you will be require<span class="err">*</span></label><br>
                                  <?php 
                                  $options = array('2'=>'General Contractor','3'=>'Sub-Contractor');
                                  $attributes = array('div' => 'input', 'type' => 'radio', 'options' => $options, 'default' => 'Y');
                                  echo $this->Form->input('contractor',$attributes);
                                  ?>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-6">
                                <label for="" style="font-weight:bold">Services:</label>
                                  <div class="d-flex">
                                    <input class="allcheck" type="checkbox" value="" style="margin-left:10px;margin-bottom:10px;">
                                    <label for="" style="margin-left:5px;">All</label>
                                  </div>
                                  <div>
                            
                                    <?php foreach($services as $service):?>
                                     <input class="check" type="checkbox" name="owner_services[][service_id]" value="<?php echo $service->id?>" style="margin-bottom:10px;margin-left:7px">
                                     <label for="" style="margin-left:1px;"> <?php echo $service->service?></label>
                                     <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                               <div class="col-md-8">
                                 <div class="text-center">
                                 <?= $this->Form->button(__('Send Request'),['class' => 'btn btn-lg bg-gradient-primary w-20 ms-4 mt-4 mb-0']) ?>
                               </div>
                               <?php echo $this->Form->end() ?>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========Add Category====== -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function(){
    $("#contractor-2").click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $("#contractor-3").click(function(){
      $('input:checkbox').not(this).prop('checked', false);
    });
    $(".allcheck").click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
    });
  });

  
  $(document).ready(function () {


jQuery.validator.addMethod("noSpace",
  function (value, element) {
    return value == "" || value.trim().length != 0;
  },
  "**No space please fill the Character"
);
/********************************************************************************/  
jQuery.validator.addMethod("lettersonly", 
function(value, element) {
  return this.optional(element) || /^[a-z]/i.test(value);
}, "**Please Letters only Not fill Space"); 


$("#projects_form").validate({

  rules: {
      project_name: {
        required: true,
        noSpace: true,
        lettersonly:true,
       
      },
    
      project_address1: {
        required: true,
        noSpace: true,
        //lettersonly:true,
      // minlength: 6,
      },

      state: {
        required: true,
        noSpace: true,
      },
      city : {
        required: true,
        noSpace: true,
        
      },

     pincode : {
          required: true,
          noSpace: true,
          digits: true,
          minlength: 6,
          maxlength: 6,

        
      },

  },

  messages: {

    project_name: {
            required: " **Please enter a First Name",
            
          },
        
          address1: {
            required: " **Please enter Address",
            
          },
        
          state: {
              required: "**Please enter your state",
          },
          city: {
              required: "**Please enter your city",
          },
          pincode: {
              required: "**please enter your pincode",
              digits: "**Only numbers are allowed",
              minlength: " **Your pincode must consist 6 Digits",
              maxlength: " **Phone pincode must consist 6 Digits",
          },
  },

 /* errorPlacement: function (error, element) {
    if (element.is(":radio")) {
      error.appendTo(".pr");
    } else {
      error.insertAfter(element);
    }
  },*/

  

});
});
</script>
