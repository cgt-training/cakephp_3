<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company'), ['action' => 'edit', $company->Company_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company'), ['action' => 'delete', $company->Company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->Company_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companies view large-9 medium-8 columns content">
    <h3><?= h($company->Company_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $company->has('company') ? $this->Html->link($company->company->Company_id, ['controller' => 'Companies', 'action' => 'view', $company->company->Company_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Name') ?></th>
            <td><?= h($company->Company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Email') ?></th>
            <td><?= h($company->Company_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Address') ?></th>
            <td><?= h($company->Company_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Profile') ?></th>
            <td><?= h($company->Company_profile) ?></td>
        </tr>
    </table>
</div>
