<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="posts form large-12 medium-12 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['class' => 'margin68']) ?>
    <?= $this->Form->end() ?>
    <?= $this->Html->link(__('CANCEL'),['action' => 'index'],['type' => 'button','class' => 'button cancel']); ?>
</div>
