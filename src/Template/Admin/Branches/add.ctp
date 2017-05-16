<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="branches form large-12 medium-12 columns content">
    <?= $this->Form->create($branch) ?>
    <fieldset>
        <legend><?= __('Add Branch') ?></legend>
        <?php
            echo $this->Form->control('company_fk_id', ['options' => $companies]);
            echo $this->Form->control('branch_name');
            echo $this->Form->control('branch_created');
        ?>
    </fieldset>
   
            <?= $this->Form->button(__('Submit'),['class' => 'margin68']) ?>
            <?= $this->Form->end() ?>
        <div class="col-md-3"> <?= $this->Html->link(__('CANCEL'),['action' => 'index'],['type' => 'button','class' => 'button cancel']); ?></div>
   
    
</div>
