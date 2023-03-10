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
                <h6 class="text-white text-capitalize ps-3">Owner View</h6>
              </div>
              </div>
            <div class="card-body px-0 pb-2">
                    <?php echo $this->Form->create($user,['id'=>'admin-form']);?>
                    <?php echo  $this->Form->control('user_profile.first_name',['class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo  $this->Form->control('user_profile.last_name',['class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo  $this->Form->control('email',['class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo  $this->Form->control('user_profile.phone',['type'=>'phone','class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo  $this->Form->control('user_profile.address1',['class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo  $this->Form->control('user_profile.address2',['class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo  $this->Form->control('user_profile.state',['class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo  $this->Form->control('user_profile.city',['class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo  $this->Form->control('user_profile.pincode',['class'=>'text-form','label'=>['class'=>'form-label']]);?>
                    <?php echo $this->Form->submit(__('edit'),['class'=>'btn btn-primary']);?>
                    <?php echo $this->Form->end();?>
            
            </div>
          </div>
        </div>
      </div>