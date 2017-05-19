<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="companies form large-12 medium-12 columns content">
    <?= $this->Form->create($company) ?>
    <fieldset>
        <legend><?= __('Add Company') ?></legend>
        <?php
            echo $this->Form->control('Company_name');
            echo $this->Form->control('Company_email');
            echo $this->Form->control('Company_address');
            echo $this->Form->control('Company_profile');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['class' => 'margin68']) ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link(__('CANCEL'),['action' => 'index'],['type' => 'button','class' => 'button cancel']); ?>
</div>
