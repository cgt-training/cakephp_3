<?php
/**
  * @var \App\View\AppView $this
  */
?>
<h2 class="h2class">Dashboard</h2>
<div class="row-fluid">
    <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Edit Profile</div>
            </div>
             <div class="block-content collapse in">
            <!-- form start -->
             <?= $this->Form->create($user,['type'=>'file']);?>
                <div class="form-group">
                  <div class="col-sm-5">
                     <?= $this->Form->control('username', ['label' => false,'placeholder'=>'name','class'=>'form-control']); ?>
                  </div>
                </div>
                <?php echo $this->Form->control('user_image',['type' => 'file']);?> 
              <div class="box-footer">
              <br>
                <?= $this->Form->button(__('Submit'),array('class'=>'btn btn-info pull-right')); ?>
              </div>
              <!-- /.box-footer -->
           <?= $this->Form->end() ?>
          </div>
    </div>
</div>