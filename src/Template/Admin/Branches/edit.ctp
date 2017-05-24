<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="branches form large-11 medium-10 columns content">
    <?= $this->Form->create($branch) ?>
    <fieldset>
        <legend><?= __('Edit Branch') ?></legend>
        <?php
            echo $this->Form->control('company_fk_id', ['options' => $companies]);
            echo $this->Form->control('branch_name');
            echo $this->Form->control('branch_created');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
