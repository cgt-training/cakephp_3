<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="companies form large-11 medium-10 columns content">
    <?= $this->Form->create($company) ?>
    <fieldset>
        <legend><?= __('Edit Company') ?></legend>
        <?php
            echo $this->Form->control('Company_name');
            echo $this->Form->control('Company_email');
            echo $this->Form->control('Company_address');
            echo $this->Form->control('Company_profile');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
