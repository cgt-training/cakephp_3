<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="companies form large-11 medium-10 columns content">
    <?= $this->Form->create($user,['type'=>'file']); ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('role', [
            'options' => ['admin' => 'Admin','subadmin' =>'Subadmin', 'author' => 'Author','guest' => 'Guest']
        ]);
            echo $this->Form->control('user_image',['type' => 'file']);
        ?> 
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
