
<!-- // category table  -->
<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">services table</h6>
          
          <?php echo $this->Html->link(__('Add Service'), [], ['class' => 'btn btn-primary float-end mt-4', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#exampleModal']) ?>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0" id='table-hide'>
          <table class="table align-items-center justify-content-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sr no:-</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Service Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Action</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="tbody">
              <?php
              $count = $this->Paginator->counter('{{start}}');
              foreach ($services as $service) {

              ?>
                <tr>
                  <td>
                    <div class="d-flex px-2">
                      <?php echo $count ?>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex px-2">

                      <div class="my-auto">
                        <h6 class="mb-0 text-sm"><?php echo $service->service ?></h6>
                      </div>
                    </div>
                  </td>

                  <td>

                    <?php
                    if ($service->service_status == 1) {
                    ?>

                      <span class="badge badge-sm bg-gradient-success">
                        <?php
                        echo 'working';
                        ?>
                      </span>
                    <?php
                    } else {
                    ?>
                      <span class="badge badge-sm bg-gradient-danger">
                      <?php
                      echo "Deleted";
                    }
                    $count++;
                      ?>
                      </span>


                  </td>

                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold"> <?php echo $this->Html->link(__(''), ['action' => '',], ['class' => 'fa-solid fa-pen-to-square mx-2 edit', 'data-id' => $service->id]); ?></span>
                      <span class="me-2 text-xs font-weight-bold">
                        <?php
                        if ($service->service_status == 1) {
                          echo $this->Html->link(__(''), ['controller' => 'Services', 'prefix' => 'Admin', 'action' => 'deleteRecoverService', $service->id], ['class' => 'fa-sharp fa-solid fa-trash delete', 'id' => 'recycle', 'data-id' => $service->id]);
                        } else {
                          echo $this->Html->link(__(''), ['controller' => 'Services', 'prefix' => 'Admin', 'action' => 'deleteRecoverService', $service->id], ['class' => 'fa-solid fa-recycle recycle', 'id' => 'delete', 'data-id' => $service->id]);
                        }
                        ?>
                      </span>
                      <div>
                      </div>
                  </td>
                </tr>
              <?php } ?>

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

<!-- //model -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->create(null, ['id' => 'modal-form']) ?>
        <fieldset>
          <legend><?= __('Add Service') ?></legend>
          <?php
          echo $this->Form->input('service', ['id' => 'service']);
          ?>
          <span class="service-error" id="service-error"></span>
        </fieldset>
        <?php echo $this->Form->button(__('Submit')) ?>
        <?php echo $this->Form->end() ?>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->create(null, ['id' => 'edit-form']) ?>
        <fieldset>
          <legend><?= __('edit Service') ?></legend>
          <?php
          echo $this->Form->input('id', ['type' => 'hidden', 'id' => 'service-id']);
          echo $this->Form->input('service', ['id' => 'get-service']);
          ?>
        </fieldset>
        <span class="service-edit-error" id="service-edit-error"></span>
        <?php echo $this->Form->button(__('Submit'), ['class' => 'edit-form']) ?>
        <?php echo $this->Form->end() ?>
      </div>

    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function () {
  $("#modal-form").validate({
    rules: {
      service : {
        required: true,
        //noSpace: true
    },
},
    messages: {
      service: {
        required: "Please enter your Service",
        //email: "Please enter valid email",
      }
    }
  });
});

</script>